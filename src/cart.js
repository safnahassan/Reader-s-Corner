$(document).ready(function(){
	$("#quantity").change(function(){
		var self = $(this);
		var unitVal = self.prev('td').val();
		self.next('td'	).val(unitVal * self.val());
	});
});
