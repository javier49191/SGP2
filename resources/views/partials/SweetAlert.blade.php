<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
	$('.btn-delete').on('click', function(e){

		Swal.fire({
			title: '<strong>Esta Seguro?</strong>',
			text: "No podrá revertir este cambio",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, borralo!'
		}).then((result) => {
			if (result.value) {
				Swal.fire(
					'Borrado!',
					'Registro borrado!.',
					'success'
					),
				$(this).parents('form:first').submit();
			}
		})
	});
</script>