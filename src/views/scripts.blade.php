
<script src="http://SortableJS.github.io/Sortable/Sortable.js"></script>
<script src="{{asset('vendor/hrm/js/main.js')}}"></script>
<script>
    var nestedSortables = $('.nested-sortable');
	for (var i = 0; i < nestedSortables.length; i++) {
		new Sortable(nestedSortables[i], {
			group: {
                name: 'nested',
                pull: function (to, from) {
                var toLvl = $(to.el).parents('.nested-sortable').length;
                if(toLvl > 1) {
                    return false;
                }
                return true;
                },
            },

            onEnd: function (/**Event*/evt) {
                var parent = $(evt.item).parent().parent().data('id');
                parent = typeof(parent)  === "undefined" ? undefined : parent;
                $(evt.item).data({
                    parent:parent,
                    index:evt.newIndex
                });
                $.ajax({
                    type: "post",
                    url: "{{url('hrm-menu/update')}}",
                    data: {
                        _token:"{{csrf_token()}}",
                        data: $(evt.item).data(),
                        menu:$('#draggable').data('menu')
                    },
                    dataType: "json",
                    success: function (response) {
                    }
                });
            },
			animation: 150,
			fallbackOnBody: true,
			swapThreshold: 0.7,
			emptyInsertThreshold: 8,
		});
	}
</script>
