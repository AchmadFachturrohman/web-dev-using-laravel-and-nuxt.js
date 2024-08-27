<template>
    <div class="container">
        <div class="content">
            <h3>Artikel</h3>
            <h6 id="article">
                <p>
                    Dalam kehidupan suatu negara, pendidikan memegang peranan yang amat
                    penting untuk menjamin kelangsungan hidup negara dan bangsa, karena
                    pendidikan merupakan wahana untuk meningkatkan dan mengembangkan
                    kualitas sumber daya manusia. Seiring dengan perkembangan teknologi
                    komputer dan teknologi informasi, sekolah-sekolah di Indonesia sudah
                    waktunya mengembangkan Sistem Informasi manajemennya agar mampu
                    mengikuti perubahan jaman.
                </p>
                <p>
                    SISKO mampu memberikan kemudahan pihak pengelola menjalankan kegiatannya
                    dan meningkatkan kredibilitas dan akuntabilitas sekolah dimata siswa,
                    orang tua siswa, dan masyakat umumnya.Penerapan teknologi informasi
                    untuk menunjang proses pendidikan telah menjadi kebutuhan bagi lembaga
                    pendidikan di Indonesia. Pemanfaatan teknologi informasi ini sangat
                    dibutuhkan untuk meningkatkan efisiensi dan produktivitas bagi manajemen
                    pendidikan. Keberhasilan dalam peningkatan efisiensi dan produktivitas
                    bagi manajemen pendidikan akan ikut menentukan kelangsungan hidup
                    lembaga pendidikan itu sendiri. Dengan kata lain menunda penerapan
                    teknologi informasi dalam lembaga pendidikan berarti menunda kelancaran
                    pendidikan dalam menghadapi persaingan global.
                </p>
                <p>
                    Pemanfaatan teknologi informasi diperuntukkan bagi peningkatan kinerja
                    lembaga pendidikan dalam upayanya meningkatkan kualitas Sumber Daya
                    Manusia Indonesia. Guru dan pengurus sekolah tidak lagi disibukkan oleh
                    pekerjaan-pekerjaan operasional, yang sesungguhnya dapat digantikan oleh
                    komputer. Dengan demikian dapat memberikan keuntungan dalam efisien
                    waktu dan tenaga.
                </p>
                <p>
                    Penghematan waktu dan kecepatan penyajian informasi akibat penerapan
                    teknologi informasi tersebut akan memberikan kesempatan kepada guru dan
                    pengurus sekolah untuk meningkatkan kualitas komunikasi dan pembinaan
                    kepada siswa. Dengan demikian siswa akan merasa lebih dimanusiakan dalam
                    upaya mengembangkan kepribadian dan pengetahuannya.
                </p>
                <p>
                    Sebagai contoh yang paling utama adalah sistem penjadwalan yang harus
                    dilakukan setiap awal semester. Biasanya membutuhkan waktu lama untuk
                    menyusun penjadwalan, Dengan SISKO dapat selesai dalam waktu singkat.
                    Untuk mempermudah bagian administrasi kurikulum sekolah, SISKO
                    menyediakan fasilitas istimewa yang merupakan inti dari sistem kurikulum
                    sekolah yaitu membantu dalam pembuatan penjadwalan mata pelajaran
                    sekolah yang dapat diproses tidak lebih lama dari 10 menit.
                    Administrator hanya akan memasukkan kondisi dari masing-masing guru yang
                    akan mengajar baik itu dalam 1 minggu seorang guru dapat mengajar berapa
                    jam, selain itu dapat juga melakukan pemesanan tempat dan penempatan
                    hari libur masing-masing guru dalam 1 minggu masa mengajar. Setelah
                    semua kondisi dimasukkan, sistem akan memproses semua data tersebut
                    sehingga menghasilkan jadwal yang optimal dan dapat langsung dipakai
                    karena sistem akan mendeteksi sehingga tidak akan ada jadwal yang
                    bertumpukan satu dengan yang lainnya.
                </p>
                <p>
                    Setelah semua kondisi dimasukkan, sistem akan memproses semua data
                    tersebut sehingga menghasilkan jadwal yang optimal dan dapat langsung dipakai
                    karena sistem akan mendeteksi sehingga tidak akan ada jadwal yang bertumpukan satu
                    dengan yang lainnya. Setelah permasalahan penjadwalan dapat ditangani dengan baik,
                    hal yang tidak kalah pentingnya adalah memasukkan data siswa.
                </p>
                <p>
                    Program SISKO telah menyediakan fasilitas untuk penanganan penilaian
                    siswa yang secara langsung memasukkan nilai ke dalam raport dan siap dicetak. Untuk
                    sistem penilaian siswa, yang dapat melakukan pengisian hanya Guru yang mengajar
                    mata pelajaran. Sistem penilaian telah disesuaikan dengan KBK sehingga masing
                    masing guru dapat memasukkan deskripsi narasi dari mata pelajaran. Untuk
                    menampilkan data penilaian dapat disesuaikan kembali dengan kebijaksanaan dari
                    masing-masing lembaga pendidikan apakah ingin menampilkan data nilai akhir siswa
                    maupun menampilkan data nilai siswa setiap kali mengadakan test ataupun tugas
                    tertentu.
                </p>
                <p>
                    Selain Modul untuk penjadwalan dan Modul Penilaian siswa, SISKO juga
                    memberikan fasilitas untuk bagian administrasi keuangan sekolah dalam hal
                    pembayaran SPP siswa. Bagian administrasi dapat langsung mengecek siapa siswa
                    yang mempunyai tunggakan SPP dan untuk detail histori pembayaran SPP dari
                    masing-masing siswa dapat dicetak seperti mencetak buku tabungan di bank sehingga
                    mempermudah pekerjaan pihak administrasi keuangan. Administrasi keuangan dapat
                    langsung melakukan pengaturan data pembayaran masing-masing siswa sesuai
                    dengan kebutuhan dan dapat diubah sewaktu-waktu apabila ada kenaikan pembayaran SPP. Apabila siswa
                    tersebut akan melakukan pembayaran, petugas dapat langsung
                    memasukkan data. Hal sama juga dapat dilakukan untuk Data pembayaran
                    Sumbangan Sukarela dan Tabungan Karyawisata.
                </p>
            </h6>
            <h6 v-html="updatedContent" v-if="showUpdatedContent"></h6>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control mr-1" placeholder="Pencarian Kata" v-model="searchWords"
                @input="searchWord">
            <h6>
                Ditemukan: {{ wordCount }} Kata
            </h6>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Replace word" v-model="replaceWords">
            <button type="submit" class="btn btn-success" @click="replaceAndToggle">Replace</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "penalaran",
    data() {
        return {
            searchWords: '',
            wordCount: 0,

            replaceWords: 'ialah',
            updatedContent: '',
            showUpdatedContent: false
        }
    },
    methods: {
        replaceAndToggle() {
            const contentElement = document.getElementById('article');
            if (contentElement) {
                this.updatedContent = contentElement.innerHTML.replace(/adalah/g, this.replaceWords);
                contentElement.style.display = 'none';
                this.showUpdatedContent = true;
            }
        },

        searchWord() {
            const articleText = document.getElementById('article').innerText.toLowerCase();
            const searchWordsLower = this.searchWords.toLowerCase();
            if (searchWordsLower.trim()) {
                const regex = new RegExp(`\\b${searchWordsLower}\\b`, 'g');
                const matches = articleText.match(regex);
                this.wordCount = matches ? matches.length : 0;
            } else {
                this.wordCount = 0;
            }
        }
    }
};
</script>

<style scoped>
.container {
    min-height: 75vh;
}

p {
    text-indent: 50px;
    text-align: justify;
    margin: 0;
    padding: 0;
}

.mr-1 {
    margin-right: 1rem !important;
    margin-left: 0 !important;
}
</style>
