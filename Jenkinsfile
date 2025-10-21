pipeline {
    // Menentukan bahwa pipeline ini bisa berjalan di agent Jenkins manapun
    agent any

    // Mendefinisikan variabel yang akan digunakan di seluruh pipeline
    environment {
        // Anda bisa mengganti nama image ini sesuai keinginan
        DOCKER_IMAGE_NAME = "dafa-justitia/laravel-app"
        // Menambahkan tag unik berdasarkan nomor build Jenkins
        DOCKER_IMAGE_TAG = "build-${env.BUILD_NUMBER}"
    }

    stages {
        // Tahap 1: Mengambil kode dari Git
        stage('Checkout') {
            steps {
                echo '🔄 Mengambil source code dari repositori Git...'
                checkout scm
            }
        }

        // Tahap 2: Menampilkan informasi build
        stage('Build Info') {
            steps {
                echo '🚀 Memulai proses build pipeline di Windows...'
                // Menggunakan 'bat' karena environment Anda adalah Windows
                bat 'docker --version'
            }
        }

        // Tahap 3: Persiapan Environment Laravel
        stage('Setup Environment') {
            steps {
                echo '📝 Menyalin .env.example ke .env...'
                // Pastikan file .env.example ada di repo Anda
                bat 'copy .env.example .env'
            }
        }

        // Tahap 4: Membangun Docker Image
        stage('Build Docker Image') {
            steps {
                echo "📦 Membangun Docker image dengan nama: ${DOCKER_IMAGE_NAME}:${DOCKER_IMAGE_TAG}..."
                // Perintah ini akan membangun image dari Dockerfile di direktori Anda
                bat "docker build -t ${DOCKER_IMAGE_NAME}:${DOCKER_IMAGE_TAG} ."
            }
        }

        // Tahap 5: Menjalankan Unit Tests
        stage('Run Tests') {
            steps {
                echo '🔬 Menjalankan PHPUnit tests di dalam container...'
                // Menjalankan container baru hanya untuk menjalankan tes
                // Perintah 'php artisan test' akan menjalankan semua tes Anda
                bat "docker run --rm ${DOCKER_IMAGE_NAME}:${DOCKER_IMAGE_TAG} php artisan test"
            }
        }
    }

    // Blok 'post' akan selalu dijalankan setelah semua tahap selesai
    post {
        always {
            echo '🧹 Membersihkan environment...'
            // Menghapus image yang baru dibuat untuk menghemat ruang
            // Hapus baris ini jika Anda ingin menyimpan image setelah build
            bat "docker rmi ${DOCKER_IMAGE_NAME}:${DOCKER_IMAGE_TAG}"

            // Membersihkan dangling images (image tanpa tag)
            bat "docker image prune -f"
            echo '🏁 Pipeline selesai dijalankan.'
        }
        success {
            echo '✅ Pipeline berhasil!'
        }
        failure {
            echo '❌ Pipeline gagal. Silakan periksa log pada tahap yang error.'
        }
    }
}
