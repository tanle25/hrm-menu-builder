<script src="https://cdn.jsdelivr.net/npm/nested-sort@5.1.0/dist/nested-sort.umd.min.js"></script>
<script>
    // Get the button that opens the modal
    var btn = document.querySelectorAll("[data-toggle-modal]");

    var modal = document.getElementById(btn[0].getAttribute("data-toggle-modal"));



    document.onclick = function(e) {
        // console.log(e.target.hasAttribute('data-toggle-modal'));
        if (e.target.hasAttribute('data-toggle-modal')) {
            var modal = document.getElementById(e.target.getAttribute("data-toggle-modal"));
            console.log(modal);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('block')
            } else {
                modal.classList.remove('block');
                modal.classList.add('hidden')
            }
        }
    }

    new NestedSort({
        el: '#draggable', // a wrapper for the dynamically generated list element
        nestingLevels:1,
        actions: {
            onDrop(data) { // receives the new list structure JSON after dropping an item
                // console.log($(this))
                $.ajax({
                    type: "post",
                    url: "{{url('hrm-menu/update')}}",
                    data: {
                        _token:"{{csrf_token()}}",
                        data: data,
                        menu:$('#draggable').data('menu')
                    },
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        // console.log($('#draggable').data('menu'));
                    }
                });
            }
        },

        listClassNames: [
        'nested-sort'], // an array of custom class names for the dynamically generated list element

    });
    $('.menu-option').click(function(){
        $header = $(this);
        $content = $header.next();
        $content.slideToggle(100, function () {

        $header.html(function () {
            //change text based on condition
            return $content.is(":visible") ?
            '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>' :

            '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
        });
    });
    });
</script>
