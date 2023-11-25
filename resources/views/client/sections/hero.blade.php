<section class="min-h-screen max-w-6xl mx-auto grid lg:grid-cols-1 lg:grid-cols-2 prose-sm">
    <div data-aos="fade-right" class="flex flex-col justify-center items-start p-4">
        <span class="py-2 px-4 rounded-lg bg-[#FFC727] text-white mb-4">Web App Persuratan</span>
        <h1 class="font-semibold">Surat Digital : RT 005/014, Kelurahan Perwira, Kecamatan Bekasi Utara</h1>
        <p class="leading-loose">Platform digital yang memudahkan proses pengajuan dan persetujuan surat oleh warga, RT, dan RW</p>
        <button type="button" id="readmore" class="btn btn-primary">Baca selengkapnya</button>
    </div>
    <div class="flex justify-center items-center p-4 order-first lg:order-2 mt-[6vh] lg:mt-0">
        <div data-aos="fade-left" class="rounded-lg overflow-hidden">
            <img 
            src={{ asset('assets/images/hero.png') }}
            alt="Hero Image"
            class="w-full max-w-md h-full object-cover "
            />
        </div>
    </div>
</section>
<script>
    document.getElementById('readmore').addEventListener('click', function() {
        window.scrollBy(0, window.innerHeight);
    });
</script>