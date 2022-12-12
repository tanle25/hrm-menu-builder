var btn = document.querySelectorAll("[data-toggle-modal]");
    var modal = document.getElementById(btn[0].getAttribute("data-toggle-modal"));
    document.onclick = function(e) {
        if (e.target.hasAttribute('data-toggle-modal')) {
            var modal = document.getElementById(e.target.getAttribute("data-toggle-modal"));
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('block')
            } else {
                modal.classList.remove('block');
                modal.classList.add('hidden')
            }
        }
    }

    $('.menu-option').click(function(){
        $header = $(this);
        $content = $header.next();
        $('.hrm-menu-builder-content[style*="display: block"]').not($content).slideToggle(100);
        $content.slideToggle(100, function () {
        $header.html(function () {
            return $content.is(":visible") ?
                '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>' :
                '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
            });
        });
    });
$('.menu-type-option').click(function(){
    $header = $(this);
    $content = $(this).next();
    console.log($('.menu-item-content[style*="display: block"]'));
    $('.menu-item-content[style*="display: block"]').not($content).slideToggle(100);
    $content.slideToggle(100);
});
