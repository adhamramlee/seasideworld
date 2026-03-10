<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Document;
use App\Models\Inquiry;
use App\Models\Page;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create pages
        $pages = [
            [
                'title_en' => 'About Us',
                'title_jp' => '会社概要',
                'content_en' => '<h2>Welcome to Global Export Car</h2><p>We are a leading exporter of quality vehicles from Japan. With over 20 years of experience in the automotive industry, we have built a reputation for excellence and reliability.</p><p>Our team of experts ensures that every vehicle meets the highest standards of quality before it leaves our facility. We take pride in our comprehensive inspection process and attention to detail.</p>',
                'content_jp' => '<h2>グローバルエクスポートカーへようこそ</h2><p>私たちは日本からの高品質車両の主要な輸出業者です。自動車業界での20年以上の経験により、卓越性と信頼性の評判を築いてきました。</p><p>専門家チームは、すべての車両が当社施設を出る前に最高水準の品質を満たしていることを保証します。当社は包括的な検査プロセスと細部へのこだわりに誇りを持っています。</p>',
                'slug' => 'about-us',
                'meta_description' => 'Learn about Global Export Car - your trusted partner for quality vehicles from Japan.',
                'status' => true,
            ],
            [
                'title_en' => 'Our Services',
                'title_jp' => 'サービス内容',
                'content_en' => '<h2>Comprehensive Export Services</h2><p>We offer end-to-end export services including:</p><ul><li>Vehicle sourcing and inspection</li><li>Export documentation and customs clearance</li><li>International shipping and logistics</li><li>Insurance and financial services</li><li>After-sales support</li></ul>',
                'content_jp' => '<h2>包括的な輸出サービス</h2><p>当社は以下のエンドツーエンドの輸出サービスを提供しています：</p><ul><li>車両の調達と検査</li><li>輸出書類と通関手続き</li><li>国際輸送と物流</li><li>保険と金融サービス</li><li>アフターサポート</li></ul>',
                'slug' => 'services',
                'meta_description' => 'Explore our comprehensive vehicle export services including sourcing, documentation, shipping, and support.',
                'status' => true,
            ],
            [
                'title_en' => 'Contact Us',
                'title_jp' => 'お問い合わせ',
                'content_en' => '<h2>Get in Touch</h2><p>We\'d love to hear from you. Whether you have a question about our vehicles, pricing, or anything else, our team is ready to answer all your questions.</p>',
                'content_jp' => '<h2>お問い合わせ</h2><p>ご意見をお聞かせください。車両、価格、その他についてご質問がある場合は、チームがすべての質問にお答えする準備ができています。</p>',
                'slug' => 'contact',
                'meta_description' => 'Contact Global Export Car for inquiries about vehicles, pricing, and export services.',
                'status' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }

        // Create categories
        $categories = [
            [
                'name_en' => 'Double Cab',
                'name_jp' => 'ダブルキャブ',
                'slug' => 'double-cab',
                'description_en' => 'Double cab vehicles with 4 doors and spacious interior',
                'description_jp' => '4ドアの広々とした室内のダブルキャブ車両',
                'status' => true,
            ],
            [
                'name_en' => 'Single Cab',
                'name_jp' => 'シングルキャブ',
                'slug' => 'single-cab',
                'description_en' => 'Single cab vehicles with 2 doors and extended cargo bed',
                'description_jp' => '2ドアで荷台が長いシングルキャブ車両',
                'status' => true,
            ],
            [
                'name_en' => 'Extra Cab',
                'name_jp' => 'エクストラキャブ',
                'slug' => 'extra-cab',
                'description_en' => 'Extra cab vehicles with additional rear jump seats',
                'description_jp' => '後部にジャンプシート付きのエクストラキャブ車両',
                'status' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create vehicles
        $categories = Category::all();
        $vehicles = [
            [
                'name_en' => 'Double Cab 2.4L Diesel',
                'name_jp' => 'ダブルキャブ 2.4L ディーゼル',
                'description_en' => 'Powerful 2.4L diesel engine with automatic transmission. Excellent condition with low mileage.',
                'description_jp' => 'パワフルな2.4Lディーゼルエンジンにオートマチックトランスミッション搭載。低走行距離の良好な状態。',
                'year' => 2022,
                'price' => 3500000,
                'status' => true,
            ],
            [
                'name_en' => 'Single Cab 2.0L Petrol',
                'name_jp' => 'シングルキャブ 2.0L ガソリン',
                'description_en' => 'Reliable 2.0L petrol engine with manual transmission. Perfect for commercial use.',
                'description_jp' => '信頼性の高い2.0Lガソリンエンジンにマニュアルトランスミッション。商用利用に最適。',
                'year' => 2021,
                'price' => 2800000,
                'status' => true,
            ],
            [
                'name_en' => 'Extra Cab 2.8L Turbo Diesel',
                'name_jp' => 'エクストラキャブ 2.8L ターボディーゼル',
                'description_en' => 'Top-of-the-line 2.8L turbo diesel with all options. Leather seats, navigation, and more.',
                'description_jp' => '最高級2.8Lターボディーゼルに全オプション装備。レザーシート、ナビゲーションなど。',
                'year' => 2023,
                'price' => 4200000,
                'status' => true,
            ],
        ];

        foreach ($vehicles as $index => $vehicleData) {
            $vehicle = Vehicle::create(array_merge($vehicleData, [
                'category_id' => $categories[$index % count($categories)]->id,
            ]));

            // Create sample images (placeholders)
            VehicleImage::create([
                'vehicle_id' => $vehicle->id,
                'image_path' => 'vehicles/sample-' . ($index + 1) . '.jpg',
                'is_primary' => true,
            ]);
        }

        // Create sample documents
        $admin = User::where('role', 'admin')->first();
        $clients = User::where('role', 'client')->get();

        $documents = [
            [
                'title_en' => 'Export Guide',
                'title_jp' => '輸出ガイド',
                'description_en' => 'Complete guide to exporting vehicles from Japan',
                'description_jp' => '日本からの車両輸出完全ガイド',
                'file_path' => 'private/documents/export-guide.pdf',
                'file_size' => 1024 * 1024 * 2, // 2MB
                'file_type' => 'application/pdf',
                'downloads' => 0,
                'status' => true,
            ],
            [
                'title_en' => 'Price List 2024',
                'title_jp' => '価格表 2024',
                'description_en' => 'Current pricing for all vehicle models',
                'description_jp' => '全車両モデルの最新価格',
                'file_path' => 'private/documents/price-list-2024.xlsx',
                'file_size' => 1024 * 512, // 512KB
                'file_type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'downloads' => 0,
                'status' => true,
            ],
            [
                'title_en' => 'Inspection Checklist',
                'title_jp' => '点検チェックリスト',
                'description_en' => 'Detailed vehicle inspection checklist',
                'description_jp' => '詳細な車両点検チェックリスト',
                'file_path' => 'private/documents/inspection-checklist.pdf',
                'file_size' => 1024 * 1024, // 1MB
                'file_type' => 'application/pdf',
                'downloads' => 0,
                'status' => true,
            ],
        ];

        foreach ($documents as $documentData) {
            $document = Document::create(array_merge($documentData, [
                'user_id' => $admin->id,
            ]));

            // Assign to all clients
            $document->users()->attach($clients->pluck('id')->toArray());
        }

        // Create sample inquiries
        $inquiries = [
            [
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'phone' => '+1 555-123-4567',
                'message' => 'I am interested in purchasing a Double Cab vehicle. Please send me more information about available models and shipping to USA.',
                'status' => 'pending',
            ],
            [
                'name' => '佐藤 健一',
                'email' => 'kenji@example.com',
                'phone' => '+81 90-1111-2222',
                'message' => '2022年モデルのハイラックスダブルキャブの在庫はありますか？価格と納期を教えてください。',
                'status' => 'replied',
            ],
            [
                'name' => 'Sarah Wilson',
                'email' => 'sarah@example.com',
                'phone' => '+44 20 1234 5678',
                'message' => 'Do you offer financing options for international buyers? Looking to purchase 2-3 vehicles for my business.',
                'status' => 'pending',
            ],
        ];

        foreach ($inquiries as $inquiryData) {
            Inquiry::create($inquiryData);
        }

        // Assign some inquiries to existing clients
        $inquiries = Inquiry::take(2)->get();
        foreach ($inquiries as $index => $inquiry) {
            $inquiry->update(['user_id' => $clients[$index % count($clients)]->id]);
        }
    }
}