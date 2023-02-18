function convertHTMLToPDF() {
	const { jsPDF } = window.jspdf;
	var pdf = new jsPDF('l', 'mm', [1200, 1210]);
	var pdfjs = document.querySelector('#pdf_content');		
	pdf.html(pdfjs, {
		callback: function(pdf) {
			pdf.save("output.pdf");
		},
		x: 10,
		y: 10
	});
}