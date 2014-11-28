<?php

/**
 * home actions.
 *
 * @package    moondo
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contacteActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
    }
	
	public function executeEnviar(sfWebRequest $request)
	{
        $pars = $request->getPostParameters();
        $errors = array();
        if (!trim($pars['mail'])) $errors[] = "Si et plau, introdueix una adreça de correu electrònic";
        if (sizeof($errors)>0) $this->getUser()->setFlash('error',implode($errors,'<br />'));
        else {
            $llista = new Llista();
            $llista->nom = trim($pars['nom']);
            $llista->mail = trim($pars['mail']);
            $llista->conegut = $pars['conegut'];
            $llista->save();
            $body = "<p>S'ha inscrit un usuari a la llista de correu:</p>";
            $body .= "<p>nom: ".str_replace("<","&lt;",str_replace(">","&gt;",$llista->nom)).'</p>';
            $body .= "<p>mail: ".str_replace("<","&lt;",str_replace(">","&gt;",$llista->mail)).'</p>';
            $body .= "<p>com ens ha conegut: ".nl2br(str_replace("<","&lt;",str_replace(">","&gt;",$llista->conegut))).'</p>';
            $mailer = $this->getMailer();
            $message = $mailer->compose();
            $message->setSubject("S'ha inscrit un usuari a la llista de correu");
            $message->setTo('info@khan-cartro.com');
            $message->setFrom('info@khan-cartro.com');
            $message->setBody($body, 'text/html');
            $mailer->send($message);
            $this->getUser()->setFlash('enviat',true);
        }
		$this->redirect(sfProjectConfiguration::getActive()->generateFrontendUrl('contacte'));
	}

}
