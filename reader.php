<?php include('./config/constants.php') ?>
<?php include('./admin/dummy.php') ?>
<?php
$book = $books[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mabook</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= url('css/output.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/5.0.375/pdf_viewer.min.css" integrity="sha512-bt54/qzXTxutlNalAuK/V3dxe1T7ZDqeEYbZPle3G1kOH+K1zKlQE0ZOkdYVwPDxdCFrdLHwneslj7sA5APizQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php include('./admin/dummy.php') ?>


<body class="bg-[url('https://www.transparenttextures.com/patterns/black-paper.png')] bg-[#1A120B]">
    <?php include('./components/header.php') ?>

    <div class="w-11/12 max-w-[1200px] mx-auto mt-12">

        <div>
            <div class="font-unifraktur text-mabook-light text-4xl font-bold" id="book-top"><?= $book['title'] ?></div>
            <div class="h-[2px] w-48 bg-mabook-midtone mt-4"></div>
            <canvas id="pdf-container" class="w-full">

            </canvas>
        </div> <!-- end value proposition -->

    </div> <!-- end container -->

    <div class="fixed bottom-8 right-8 bg-white p-3 rounded-xl shadow-2xl">
        <div class="gap-3 mb-2 items-center">
            <button class="bg-mabook-midtone p-2 text-white font-semibold rounded-xl cursor-pointer" id="prev"><i class="fas fa-chevron-left"></i> Previous</button>
            <button class="bg-mabook-midtone p-2 text-white font-semibold rounded-xl cursor-pointer" id="next">Next <i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="text-center font-semibold text-gray-600">Page: <span id="page_num"></span> / <span id="page_count"></span></div>

    </div>

    <?php include('./components/footer.php') ?>
    <script type="module" src="https://mozilla.github.io/pdf.js/build/pdf.mjs"></script>

    <script type="module">
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        var url = '<?= url('docs/sample.pdf') ?>';


        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var {
            pdfjsLib
        } = globalThis;

        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.mjs';

        var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 0.8,
            canvas = document.getElementById('pdf-container'),
            ctx = canvas.getContext('2d');

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
        function renderPage(num) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport({
                    scale: scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').textContent = num;
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Displays previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
            window.location = '#book-top'
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
            window.location = '#book-top'
        }
        document.getElementById('next').addEventListener('click', onNextPage);

        /**
         * Asynchronously downloads PDF.
         */
        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page_count').textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum);
        });
    </script>
</body>

</html>