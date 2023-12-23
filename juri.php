<?php include('layouts/head.php') ?>
<div class="container py-5">
    <div class="row">
        <h1 class="text-center">Juri 1</h1>
        <h4 class="bg-primary text-center text-white py-2 ml-0 rounded">Biru</h4>
        <div class="data-diri">
            <table class="table w-50">
                <tbody>
                    <tr>
                        <th scope="row">Nama</th>
                        <td><span class="mr-2">:</span> Ottossssssssssss</td>
                    </tr>
                    <tr>
                        <th scope="row">Kontingen</th>
                        <td><span class="mr-2">:</span> Thornton</td>
                    </tr>
                    <tr>
                        <th scope="row">Kategori</th>
                        <td><span class="mr-2">:</span> Seni</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="penilaian-1">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="3" class="text-center bg-info rounded-top">Penilaian</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Unsur</th>
                        <td class="w-75 text-center">Nilai</td>
                    </tr>
                    <tr>
                        <th>
                            setiap kesalahan gerak <br>
                            (- 0.01)
                        </th>
                        <td colspan="2" class="text-center">
                            <h3>
                                <span id="nilaiAwalA">
                                    <b>
                                        9.90
                                    </b>
                                </span>
                                - 0.01
                                (<span id="jumlahKlikA">
                                    <u>n</u>
                                </span>)
                            </h3>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <b>Total Nilai</b>
                        </th>
                        <td colspan="2" class="text-center"><span id="nilaiA">9.90</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end gap-3">
                <button id="kurangiNilaiA" class="btn btn-success p-5">- 0.01</button>
                <!-- <button id="simpan" class="btn btn-warning p-5" type="submit">Simpan</button> -->
            </div>
        </div>
        <div class="penilaian-2 mt-5">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>
                            ritme, penghayatan, tenaga & stamina
                            <br>
                            (0.01 - 0.10)
                        </th>
                        <td colspan="2" class="text-center w-75">
                            <h3>
                                0.01 + 0.01 (<span id="jumlahKlikB">n</span>)
                            </h3>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <b>Total Nilai</b>
                        </th>
                        <td colspan="2" class="text-center"><span id="nilaiB">0.01</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end gap-3">
                <button id="resetB" class="btn btn-danger p-5">Reset</button>
                <button id="tambahNilaiB" class="btn btn-success p-5">+ 0.01</button>
                <button id="simpan" class="btn btn-warning p-5" type="submit">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?php include('layouts/footer.php') ?>
<script>
    let nilaiA = 9.90
    let pengurangan = 0.01
    let jumlahKlikA = 0

    const nilaiElemenA = document.getElementById('nilaiA');
    const nilaiAwalElemenA = document.getElementById('nilaiAwalA');
    const jumlahKlikElemenA = document.getElementById('jumlahKlikA');

    document.getElementById('kurangiNilaiA').addEventListener('click', function () {
        nilaiA -= pengurangan;
        jumlahKlikA++;

        nilaiElemenA.textContent = nilaiA.toFixed(2); // Menampilkan nilai dengan 2 desimal
        jumlahKlikElemenA.textContent = jumlahKlikA;
    });

    let nilaiB = 0.01
    let penjumlahan = 0.01
    let jumlahKlikB = 0

    const nilaiElemenB = document.getElementById('nilaiB');
    const jumlahKlikElemenB = document.getElementById('jumlahKlikB');

    document.getElementById('tambahNilaiB').addEventListener('click', function () {
        if (jumlahKlikB < 9) {
            nilaiB += penjumlahan;
            jumlahKlikB++;

            nilaiElemenB.textContent = nilaiB.toFixed(2);
            jumlahKlikElemenB.textContent = jumlahKlikB;
        } else {
            // Tambahkan aksi ketika jumlah klik mencapai batas maksimum (10)
            Swal.fire({
                icon: 'warning',
                title: 'Batas Maksimum Terlampaui!',
                text: 'Anda telah mencapai nilai maksimum 0.10',
            });
        }
    });


    document.getElementById('simpan').addEventListener('click', function () {
        // const confirmation = confirm('Apakah Anda yakin ingin menyimpan nilai?');
        // if (confirmation) {
        //     sendDataToServer(nilaiA, nilaiB);
        //     resetValues();
        // }

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda akan menyimpan data!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                sendDataToServer(nilaiA, nilaiB);
                resetValues();
                Swal.fire('Disimpan!', 'Data Anda telah berhasil disimpan.', 'success');
            }
        });
    });

    function sendDataToServer(nilaiA, nilaiB) {
        const combinedData = `nilai=${nilaiA}&nilaiB=${nilaiB}`;
        // Kirim nilai ke server dengan AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'save.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(combinedData);
    }

    function resetValues() {
        nilaiA = 9.90; // Mengembalikan nilai ke nilai awal
        jumlahKlikA = 0; // Mereset jumlah klik

        nilaiB = 0.01; // Mengembalikan nilai ke nilai awal
        jumlahKlikB = 0; // Mereset jumlah klik

        nilaiElemenA.textContent = nilaiA.toFixed(2);
        jumlahKlikElemenA.textContent = jumlahKlikA;

        nilaiElemenB.textContent = nilaiB.toFixed(2);
        jumlahKlikElemenB.textContent = jumlahKlikB;
    }
    document.getElementById('resetB').addEventListener('click', (e) => {
        e.preventDefault()
        resetNilaiB()
    })
    function resetNilaiB() {
        nilaiB = 0.01
        jumlahKlikB = 0

        nilaiElemenB.textContent = nilaiB.toFixed(2);
        jumlahKlikElemenB.textContent = jumlahKlikB;
    }
</script>