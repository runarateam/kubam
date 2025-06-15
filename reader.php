<?php require_once(__DIR__ . '/config/constants.php') ?>
<?php require_once(__DIR__ . '/functions/helper.php') ?>
<?php require_once(__DIR__ . '/functions/session.php') ?>
<?php require_once(__DIR__ . '/functions/guest.php') ?>
<?php require_once(__DIR__ . '/functions/books.php') ?>
<?php require_once(__DIR__ . '/functions/bookmarks.php') ?>
<?php require_once(__DIR__ . '/functions/comments.php') ?>
<?php
$userId = $loggedUser['id'];

$id = $_GET['book_id'];
$book = getBook($id);
$bookmark = getBookmarkByBookId($userId, $book['id']);
$lastPageRead = $bookmark['last_page_read'];

$comments = listComments($book['id']);

if (isset($_POST['remove'])) {
    header('Location: reader.php?book_id=' . $book['id']);
    deleteBookmark($bookmark['id']);
}

if (isset($_POST['save'])) {
    $bookId = $id;
    $lastPage = $_POST['last_page'];

    setBookmark($userId, $bookId, $lastPage);
    header('Location: reader.php?book_id=' . $book['id']);
    exit;
}


if (isset($_POST['save_comment'])) {
    $comment = $_POST['comment'];
    $_SESSION['old'] = $_POST;

    if (empty($comment)) {
        $_SESSION['errors'] = ['comment' => 'Komentar tidak dapat kosong'];
        header('Location: reader.php?book_id=' . $book['id']);
        exit;
    };

    createComment($userId, $book['id'], $comment);
    unset($_SESSION['old']);
    header('Location: reader.php?book_id=' . $book['id']);
}

if (isset($_POST['remove_comment'])) {
    $id = $_POST['id'];
    deleteComment($userId, $id);
    header('Location: reader.php?book_id=' . $book['id']);
}
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

<?php require_once(__DIR__ . '/admin/dummy.php') ?>


<body class="bg-[url('https://www.transparenttextures.com/patterns/black-paper.png')] bg-[#1A120B]">
    <?php require_once(__DIR__ . '/components/header.php') ?>

    <div class="w-11/12 max-w-[1200px] mx-auto mt-12">

        <div>
            <div class="font-unifraktur text-mabook-light text-4xl font-bold" id="book-top"><?= $book['title'] ?></div>
            <div class="h-[2px] w-48 bg-mabook-midtone mt-4"></div>
            <div class="flex gap-4 flex-col lg:flex-row">
                <canvas id="pdf-container" class="w-full lg:w-8/12">

                </canvas>
                <div class="w-full lg:w-4/12">
                    <h3 class="text-2xl font-crimson font-bold text-mabook-light">Comments : </h3>
                    <div class="h-[2px] w-48 bg-mabook-midtone my-3"></div>
                    <form action="#" method="POST" class="mb-8">
                        <textarea name="comment" id="" class="mabook-form-control bg-mabook-primary" placeholder="Tuliskan komentar..."><?= $old['comment'] ?? '' ?></textarea>
                        <?php if (isset($errors['comment'])) : ?>
                            <p class="text-red-400 mb-2 text-sm italic"><?= $errors['comment'] ?></p>
                        <?php endif; ?>
                        <input type="submit" name="save_comment" class="mabook-btn-primary">
                    </form>
                    <div class="flex flex-col gap-4 pl-3">
                        <?php foreach ($comments as $comment) : ?>
                            <div class="flex gap-2 justify-between items-center">
                                <div class="flex flex-col font-crimson gap-2">
                                    <div class="text-xl font-bold text-mabook-light"><?= $comment['user_name'] ?> : </div>
                                    <p class="font-semibold text-lg text-mabook-light/70 border-l-4 border-l-mabook-light/50 pl-3"><?= $comment['comment'] ?></p>
                                </div>
                                <form action="#" method="POST" onsubmit="return confirm('Anda yakin?')">
                                    <button type="submit" name="remove_comment" class="text-red-400 cursor-pointer mr-2 relative group">
                                        <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                                        <div class="absolute -top-full whitespace-nowrap text-xs bg-mabook-light text-mabook-primary group-hover:opacity-100 opacity-0 duration-200 -translate-x-1/2 py-1 px-2 rounded-xl font-semibold font-crimson">Hapus komentar</div>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div> <!-- end value proposition -->

    </div> <!-- end container -->

    <div class="fixed bottom-8 right-8 bg-white p-3 rounded-xl shadow-2xl">
        <form action="#" method="POST">
            <input type="hidden" name="last_page">
            <?php if (empty($bookmark)) : ?>
                <button name="save" type="submit" class="bg-pink-500 p-2 w-full mb-2 text-white font-semibold rounded-xl cursor-pointer"><i class="fas fa-bookmark mr-1"></i> Save</button>
            <?php else: ?>
                <button name="remove" type="submit" class="bg-gray-500 p-2 w-full mb-2 text-white font-semibold rounded-xl cursor-pointer"><i class="fas fa-bookmark mr-1"></i> Remove Favorite</button>
            <?php endif; ?>
        </form>
        <div class="gap-3 mb-2 items-center">
            <button class="bg-mabook-midtone p-2 text-white font-semibold rounded-xl cursor-pointer" id="prev"><i class="fas fa-chevron-left"></i> Previous</button>
            <button class="bg-mabook-midtone p-2 text-white font-semibold rounded-xl cursor-pointer" id="next">Next <i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="text-center font-semibold text-gray-600">Page: <span id="page_num"></span> / <span id="page_count"></span></div>

    </div>

    <?php require_once(__DIR__ . '/components/footer.php') ?>
    <script type="module" src="<?= url('js/pdf.mjs') ?>"></script>

    <script type="module">
        var hasBookmark = <?= empty($bookmark) ? 'false' : 'true' ?>

        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        var url = '<?= url($book['file']) ?>';


        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var {
            pdfjsLib
        } = globalThis;

        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = '<?= url('js/pdf-worker.mjs') ?>';

        var pdfDoc = null,
            pageNum = <?= $lastPageRead ?? 1 ?>,
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
            document.querySelector("[name='last_page']").value = num;

            if (hasBookmark) {
                const formData = new URLSearchParams();
                formData.append('user_id', <?= $userId ?>);
                formData.append('book_id', <?= $book['id'] ?>);
                formData.append('last_read_page', num);

                fetch('<?= url('save_last_read.php') ?>', {
                    method: 'POST',
                    body: formData
                })
            }
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