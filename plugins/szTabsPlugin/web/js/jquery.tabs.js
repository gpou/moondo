$(document).ready(
	function() {
		//When page loads...
		$(".tab_content").hide(); //Hide all content
		$("ul.tabs li:first").addClass("active").show(); //Activate first tab
		//On Click Event
		$("ul.tabs li").click(
			function() {
				$("ul.tabs li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tab_content").hide(); //Hide all tab content

				var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active ID content
				$.get($(this).find('a[rel]').attr('rel'));
				return false;
			}
		);

		var first_error = $("ul.error_list:first");
		if(first_error.length > 0) {
			var tab = first_error.parents(".tab_content").first();
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$("a[href=#"+tab.attr("id")+"]").parents("li").first().addClass("active");
			tab.show();
			return;
		}

		var tab = false;
		var l = window.location.href.toLowerCase();
		if (l.indexOf("#tab")>0) {
			l = l.substring(l.indexOf("#tab"));
			var tab = $(l);
		} else {
			var l=$('a[name=activetab]');
			if(l.length>0) {
				var tab = l.parent('.tab_content').first();
			}
		}
		if (tab && tab.length>0 && tab.hasClass("tab_content")) {
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$("a[href=#"+tab.attr("id")+"]").parents("li").first().addClass("active");
			tab.show();
			return;
		} else {
			$(".tab_content:first").show(); //Show first tab content
		}
		
	   //$(".tab_content:first").show(); //Show first tab content
	}
);
