function printDiv() {
    var devContents = document.getElementById("print").innerHTML;
    var a = window.open('', '', 'height-1920, width-1080');
    a.document.write(' <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css"><html>');
    a.document.write('<html>');
    a.document.write('body');
    a.document.write(devContents);
    a.document.write('<body></html>');
    a.document.close;
    a.print();
}