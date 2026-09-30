<?php
// 1. Data Produk disimpan dalam Multidimensional Array PHP (Minimal 6 Produk)
$daftar_produk = [
    [
        "nama"     => "Kemeja Oversized Linen",
        "kategori" => "Pakaian Pria",
        "harga"    => 189000,
        "stok"     => 12
    ],
    [
        "nama"     => "Celana Chino Slim Fit",
        "kategori" => "Pakaian Pria",
        "harga"    => 225000,
        "stok"     => 5
    ],
    [
        "nama"     => "Jaket Denim Casual",
        "kategori" => "Outerwear",
        "harga"    => 350000,
        "stok"     => 0 // Stok habis untuk pengujian percabangan
    ],
    [
        "nama"     => "Sepatu Sneakers Canvas",
        "kategori" => "Sepatu",
        "harga"    => 299000,
        "stok"     => 8
    ],
    [
        "nama"     => "Tas Ransel Laptop Minimalis",
        "kategori" => "Aksesoris",
        "harga"    => 175000,
        "stok"     => 0 // Stok habis untuk pengujian percabangan
    ],
    [
        "nama"     => "Topi Baseball Polos",
        "kategori" => "Aksesoris",
        "harga"    => 45000,
        "stok"     => 20
    ]
];

// 2. Menghitung jumlah seluruh produk secara otomatis
$total_produk = count($daftar_produk);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Santuy Store - Katalog Produk</title>
    <style>
        /* CSS Reset & Variable Warna */
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --success-color: #16a34a;
            --danger-color: #dc2626;
            --border-color: #e2e8f0;
            --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.6;
        }

        /* 1. Header & Navbar */
        header {
            background-color: var(--card-bg);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-main);
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        /* 2. Hero Section dengan Gambar Background */
        .hero {
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)), 
                        url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
            color: #ffffff;
            text-align: center;
            padding: 5rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .hero-content {
            max-width: 700px;
        }

        .hero h1 {
            font-size: 2.75rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            letter-spacing: -0.025em;
        }

        .hero p {
            font-size: 1.15rem;
            color: #e2e8f0;
            margin-bottom: 1.5rem;
        }

        .hero .btn-hero {
            display: inline-block;
            background-color: var(--primary-color);
            color: #ffffff;
            padding: 0.75rem 1.75rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s, transform 0.2s;
        }

        .hero .btn-hero:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Container Utama */
        .container {
            max-width: 1200px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
        }

        /* 3. Informasi Jumlah Produk */
        .catalog-info {
            background-color: var(--card-bg);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .catalog-info h2 {
            font-size: 1.25rem;
        }

        .total-badge {
            background-color: #eff6ff;
            color: var(--primary-color);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* 4. Grid Katalog Produk (CSS Grid) */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        /* Card Produk */
        .product-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .category {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            font-weight: 600;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            font-weight: 600;
        }

        .status-available {
            background-color: #dcfce7;
            color: var(--success-color);
        }

        .status-out {
            background-color: #fee2e2;
            color: var(--danger-color);
        }

        .product-title {
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .product-stock {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        /* Tombol Beli */
        .btn-buy {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-disabled {
            background-color: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
        }

        /* 5. Footer */
        footer {
            background-color: var(--card-bg);
            border-top: 1px solid var(--border-color);
            text-align: center;
            padding: 1.5rem;
            margin-top: 4rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Responsif Sederhana */
        @media (max-width: 640px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }
            .hero {
                padding: 3.5rem 1rem;
            }
            .hero h1 {
                font-size: 2rem;
            }
            .catalog-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- 1. Navbar / Header -->
    <header>
        <nav class="navbar">
            <div class="logo">Santuy Store</div>
            <ul class="nav-links">
                <li><a href="#">Beranda</a></li>
                <li><a href="#katalog">Katalog</a></li>
                <li><a href="#">Tentang Kami</a></li>
            </ul>
        </nav>
    </header>

    <!-- 2. Hero Section dengan Gambar Pembuka -->
    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang di Santuy Store</h1>
            <p>Belanja gaya pakaian & aksesoris kekinian dengan mudah, santai, dan harga terjangkau.</p>
            <a href="#katalog" class="btn-hero">Lihat Katalog</a>
        </div>
    </section>

    <!-- Content Utama -->
    <main class="container" id="katalog">
        
        <!-- 3. Informasi Jumlah Seluruh Produk -->
        <div class="catalog-info">
            <h2>Daftar Produk Kami</h2>
            <div class="total-badge">
                Total Produk: <?php echo $total_produk; ?> Item
            </div>
        </div>

        <!-- 4. Katalog Produk (Perulangan & Percabangan PHP) -->
        <div class="product-grid">
            <?php foreach ($daftar_produk as $item): ?>
                <?php 
                    // Format Harga ke Rupiah
                    $harga_rupiah = "Rp " . number_format($item['harga'], 0, ',', '.');
                    
                    // Percabangan PHP untuk menentukan status stok & button
                    $is_available = $item['stok'] > 0;
                    $status_label = $is_available ? "Tersedia" : "Stok Habis";
                    $status_class = $is_available ? "status-available" : "status-out";
                ?>

                <!-- Card Produk -->
                <div class="product-card">
                    <div>
                        <div class="card-header">
                            <span class="category"><?php echo htmlspecialchars($item['kategori']); ?></span>
                            <!-- Status Produk -->
                            <span class="status-badge <?php echo $status_class; ?>">
                                <?php echo $status_label; ?>
                            </span>
                        </div>
                        
                        <h3 class="product-title"><?php echo htmlspecialchars($item['nama']); ?></h3>
                        
                        <!-- Harga Format Rupiah -->
                        <div class="product-price"><?php echo $harga_rupiah; ?></div>
                        
                        <div class="product-stock">Sisa Stok: <?php echo $item['stok']; ?> unit</div>
                    </div>

                    <!-- Tombol Pembelian Aktif / Nonaktif -->
                    <div>
                        <?php if ($is_available): ?>
                            <button class="btn-buy btn-primary">Beli Sekarang</button>
                        <?php else: ?>
                            <button class="btn-buy btn-disabled" disabled>Stok Habis</button>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Santuy Store. All rights reserved.</p>
    </footer>

</body>
</html>