<?php
$authors = [
    [
        'id' => 1,
        'name' => 'Andrea Hirata',
        'website' => 'https://andreahirata.com',
        'description' => 'Penulis novel terkenal asal Indonesia, dikenal lewat karya-karya inspiratif seperti Laskar Pelangi.'
    ],
    [
        'id' => 2,
        'name' => 'Tere Liye',
        'website' => 'https://tereliye.com',
        'description' => 'Penulis produktif Indonesia yang banyak menulis novel bergenre drama, fantasi, dan motivasi.'
    ],
    [
        'id' => 3,
        'name' => 'J.K. Rowling',
        'website' => 'https://www.jkrowling.com',
        'description' => 'Penulis asal Inggris, pencipta seri novel Harry Potter yang sangat terkenal di seluruh dunia.'
    ],
    [
        'id' => 4,
        'name' => 'George Orwell',
        'website' => 'https://orwellfoundation.com',
        'description' => 'Penulis dan jurnalis Inggris yang dikenal dengan karya distopia seperti 1984 dan Animal Farm.'
    ],
    [
        'id' => 5,
        'name' => 'Yuval Noah Harari',
        'website' => 'https://www.ynharari.com',
        'description' => 'Sejarawan dan penulis asal Israel yang dikenal lewat buku Sapiens dan Homo Deus.'
    ],
];
$publishers = [
    [
        'id' => 1,
        'name' => 'Bentang Pustaka',
        'website' => 'https://bentangpustaka.com',
        'description' => 'Penerbit buku Indonesia yang menerbitkan berbagai buku fiksi dan non-fiksi berkualitas.'
    ],
    [
        'id' => 2,
        'name' => 'Gramedia Pustaka Utama',
        'website' => 'https://gpu.id',
        'description' => 'Salah satu penerbit terbesar di Indonesia, terkenal dengan karya sastra dan buku populer.'
    ],
    [
        'id' => 3,
        'name' => 'Bloomsbury Publishing',
        'website' => 'https://www.bloomsbury.com',
        'description' => 'Penerbit asal Inggris yang menerbitkan buku-buku besar seperti seri Harry Potter.'
    ],
];

$books = [
    [
        'title' => 'Laskar Pelangi',
        'exemplars' => 12,
        'author_id' => 1,
        'publisher_id' => 2,
        'year' => 2005,
        'book_file' => null,
        'thumbnail' => '/images/laskar-pelangi.jpg',
        'created_at' => '2023-01-10 10:00:00',
        'publisher' => $publishers[1],
        'author' => $authors[0],
    ],
    [
        'title' => 'Bumi',
        'exemplars' => 8,
        'author_id' => 2,
        'publisher_id' => 1,
        'year' => 2014,
        'book_file' => null,
        'thumbnail' => '/images/bumi.jpg',
        'created_at' => '2023-02-15 11:20:00',
        'publisher' => $publishers[1],
        'author' => $authors[1],
    ],
    [
        'title' => 'Harry Potter and the Philosopher\'s Stone',
        'exemplars' => 15,
        'author_id' => 3,
        'publisher_id' => 3,
        'year' => 1997,
        'book_file' => null,
        'thumbnail' => '/images/harry-potter.webp',
        'created_at' => '2023-03-01 09:45:00',
        'publisher' => $publishers[2],
        'author' => $authors[2],
    ],
    [
        'title' => '1984',
        'exemplars' => 5,
        'author_id' => 4,
        'publisher_id' => 3,
        'year' => 1949,
        'book_file' => null,
        'thumbnail' => '/images/1984.jpg',
        'created_at' => '2023-04-12 14:30:00',
        'publisher' => $publishers[3],
        'author' => $authors[3],
    ],
    [
        'title' => 'Sapiens: A Brief History of Humankind',
        'exemplars' => 10,
        'author_id' => 5,
        'publisher_id' => 3,
        'year' => 2011,
        'book_file' => null,
        'thumbnail' => '/images/sapiens.jpg',
        'created_at' => '2023-05-20 13:15:00',
        'publisher' => $publishers[4],
        'author' => $authors[4],
    ],
];
