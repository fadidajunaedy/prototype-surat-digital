@extends('client.layouts.template')
@section('content')

<section class="min-h-screen max-w-6xl mx-auto p-4 prose-sm">
    <div class="overflow-x-auto mt-[12vh] w-full rounded-lg shadow-xl p-4 bg-base-100">
        <div class="w-full flex justify-between items-center">
            <h2 class="">Pengajuan</h2>
            <button type="button" onclick="modalPengajuan.showModal()" class="btn btn-sm btn-square btn-primary font-bold">
                {{-- Icon Plus --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z"/>
                </svg>
            </button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Nomor Pengantar</th>
                    <th>Tanggal Berlaku</th>
                    <th>Keperluan</th>
                    <th class="text-center">Status RT</th>
                    <th class="text-center">Status RW</th>
                    <th>Keterangan</th>
                    <th class="text-center">File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>PNTR/05/014/001</td>
                    <td>21 November 2023</td>
                    <td>Pembuatan SKCK</td>
                    <td class="text-center">
                        <div class="badge badge-sm bg-warning text-white font-semibold badge-outline py-4 px-4">Pending</div>
                        <div class="badge badge-sm bg-success text-white font-semibold badge-outline py-4 px-4">Valid</div>
                        <div class="badge badge-sm bg-error text-white font-semibold badge-outline py-4 px-4">Invalid</div>
                    </td>
                    <td class="text-center">Status RW</td>
                    <td>Keterangan</td>
                    <td class="text-center">
                        <a href="" class="btn btn-sm btn-square btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
@include('components.modals.pengajuan')
@endsection