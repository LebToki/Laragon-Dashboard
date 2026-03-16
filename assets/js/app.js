(function ($) {
  'use strict';

  // sidebar submenu collapsible js
  $(".sidebar-menu .dropdown").on("click", function(){
    var item = $(this);
    item.siblings(".dropdown").children(".sidebar-submenu").slideUp();

    item.siblings(".dropdown").removeClass("dropdown-open");

    item.siblings(".dropdown").removeClass("open");

    item.children(".sidebar-submenu").slideToggle();

    item.toggleClass("dropdown-open");
  });

  $(".sidebar-toggle").on("click", function(){
    $(this).toggleClass("active");
    $(".sidebar").toggleClass("active");
    $(".dashboard-main").toggleClass("active");
  });

  $(".sidebar-mobile-toggle").on("click", function(){
    $(".sidebar").addClass("sidebar-open");
    $("body").addClass("overlay-active");
  });

  $(".sidebar-close-btn").on("click", function(){
    $(".sidebar").removeClass("sidebar-open");
    $("body").removeClass("overlay-active");
  });

  //to keep the current page active
  $(function () {
    for (
      var nk = window.location,
        o = $("ul#sidebar-menu a")
          .filter(function () {
            return this.href == nk;
          })
          .addClass("active-page") // anchor
          .parent()
          .addClass("active-page");
      ;

    ) {
      // li
      if (!o.is("li")) break;
      o = o.parent().addClass("show").parent().addClass("open");
    }
  });


// Plugin Hub Router
window.openPluginHub = function() {
    console.log('openPluginHub called');
    console.log('Current URL:', window.location.href);
    window.location.href = '/index.php?page=plugins';
};

  /**
* Utility function to calculate the current theme setting based on localStorage.
*/
function calculateSettingAsThemeString({ localStorageTheme }) {
  if (localStorageTheme !== null) {
    return localStorageTheme;
  }
  return "light"; // default to light theme if nothing is stored
}

/**
* Utility function to update the button text and aria-label.
*/
function updateButton({ buttonEl, isDark }) {
  const newCta = isDark ? "dark" : "light";
  buttonEl.setAttribute("aria-label", newCta);
  buttonEl.innerText = newCta;
}

/**
* Utility function to update the theme setting on the html tag.
*/
function updateThemeOnHtmlEl({ theme }) {
  document.querySelector("html").setAttribute("data-theme", theme);
}

/**
* 1. Grab what we need from the DOM and system settings on page load.
*/
const button = document.querySelector("[data-theme-toggle]");
const localStorageTheme = localStorage.getItem("theme");

/**
* 2. Work out the current site settings.
*/
let currentThemeSetting = calculateSettingAsThemeString({ localStorageTheme });

/**
* 3. If the button exists, update the theme setting and button text according to current settings.
*/
if (button) {
  updateButton({ buttonEl: button, isDark: currentThemeSetting === "dark" });
  updateThemeOnHtmlEl({ theme: currentThemeSetting });

  /**
  * 4. Add an event listener to toggle the theme.
  */
  button.addEventListener("click", (event) => {
    const newTheme = currentThemeSetting === "dark" ? "light" : "dark";

    localStorage.setItem("theme", newTheme);
    updateButton({ buttonEl: button, isDark: newTheme === "dark" });
    updateThemeOnHtmlEl({ theme: newTheme });

    currentThemeSetting = newTheme;
  });
} else {
  // If no button is found, just apply the current theme to the page
  updateThemeOnHtmlEl({ theme: currentThemeSetting });
}


// =========================== Table Header Checkbox checked all js Start ================================
$('#selectAll').on('change', function () {
  $('.form-check .form-check-input').prop('checked', $(this).prop('checked')); 
}); 

  // Remove Table Tr when click on remove btn start
  $('.remove-btn').on('click', function () {
    $(this).closest('tr').remove(); 

    // Check if the table has no rows left
    if ($('.table tbody tr').length === 0) {
      $('.table').addClass('bg-danger');

      // Show notification
      $('.no-items-found').show();
    }
  });
  // Remove Table Tr when click on remove btn end

  // Custom FullCalendar override to add .fc-today to <th>
  // This executes after full-calendar is initialized if it exists on the page
  $(window).on('load', function() {
    if ($.fn.fullCalendar && $('#calendar').length) {
      function updateCalendarHeaders() {
        // Find the td that represents today
        var $todayTd = $('#calendar').find('td.fc-today');

        // Remove .fc-today and .fc-state-highlight from all th elements first
        $('#calendar').find('th.fc-day-header, th.fc-col').removeClass('fc-today fc-state-highlight');

        if ($todayTd.length) {
          $todayTd.each(function() {
            var $td = $(this);
            var date = $td.data('date');

            if (date) {
               // Find th with matching class based on day (e.g. fc-mon, fc-tue)
               var classList = $td.attr('class').split(/\s+/);
               var dayClass = classList.find(c => c.match(/^fc-[a-z]{3}$/) && c !== 'fc-day');

               if (dayClass) {
                   var $headerRow = $td.closest('table').find('thead');
                   if ($headerRow.length) {
                       $headerRow.find('th.' + dayClass).addClass('fc-today fc-state-highlight');
                   } else {
                       // Try agenda view
                       var colClass = classList.find(c => c.match(/^fc-col\d+$/));
                       if (colClass) {
                           $('#calendar').find('th.' + colClass).addClass('fc-today fc-state-highlight');
                       }
                   }
               }
            } else {
               // Fallback: map by index if data-date is not present
               var index = $td.index();
               // in basic view, header row has same number of columns
               var $headerRow = $td.closest('table').find('thead tr');
               $headerRow.children('th').eq(index).addClass('fc-today fc-state-highlight');

               // agenda day/week view
               if ($td.hasClass('fc-col0') || $td.is('[class*="fc-col"]')) {
                   var colClassMatch = $td.attr('class').match(/fc-col(\d+)/);
                   if (colClassMatch) {
                       $('#calendar').find('th.fc-col' + colClassMatch[1]).addClass('fc-today fc-state-highlight');
                   }
               }
            }
          });
        }
      }

      // Initial update
      setTimeout(updateCalendarHeaders, 100);

      // Setup a MutationObserver to re-apply the class when the calendar changes views or dates
      var calendarNode = document.getElementById('calendar');
      if (calendarNode) {
        var observer = new MutationObserver(function(mutations) {
          updateCalendarHeaders();
        });
        observer.observe(calendarNode, { childList: true, subtree: true });
      }
    }
  });

})(jQuery);