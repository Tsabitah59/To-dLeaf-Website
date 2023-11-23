
// Jam
window.setTimeout("waktu()", 1000);
 
function waktu() {
	var waktu = new Date();
	setTimeout("waktu()", 1000);

	document.getElementById("jam").innerHTML = waktu.getHours() + " • ";
	document.getElementById("menit").innerHTML = waktu.getMinutes() + " • ";
	document.getElementById("detik").innerHTML = waktu.getSeconds();
}

function confirmDelete(event, taskId){
	event.preventDefault();
	Swal.fire({
		title: "Are you sure",
		text: "that you want to delete this plan?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#79AC78",
		cancelButtonColor: "#618264",
		confirmButtonText: "Yes, delete it!",
		iconColor: "#B0D9B1",
	  }).then((result) => {
		if (result.isConfirmed) {
		  Swal.fire({
			title: "Deleted!",
			text: "Your plan has been deleted.",
			confirmButtonColor: "#79AC78",
			icon: "success"
		  }).then((willDelete) => {
			if (willDelete) {
			  window.location.href = `?delete=${taskId}`;
			}
		  });
		}
	});
}


