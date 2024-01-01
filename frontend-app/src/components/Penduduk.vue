<template>
    <div class="container">
        <h1 class="text-center mt-3">Penduduk</h1>
        <div class="card mb-5">
            <h3 class="ms-3 mb-3 mt-3">Form Penduduk</h3>
            <form @submit.prevent="simpan()">
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>NIK</label>
                    <input type="text" class="form-control" v-model="penduduk.nik">
                </div>
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Nama Penduduk</label>
                    <input type="text" class="form-control" v-model="penduduk.nama">
                </div>
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" v-model="penduduk.alamat">
                </div>
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Tanggal Lahir</label>
                    <input type="text" class="form-control" v-model="penduduk.lahir">
                </div>
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Agama ID</label>
                    <select v-model="penduduk.agama_id" class="form-control">
                        <option v-for="agama in allAgama" :key="agama.id" :value="agama.id">{{ agama.agama }}</option>
                    </select>
                </div>
                <div class="btn-group mb-5 ms-3 me-3">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-warning" type="button" @click="clear()">Clear</button>
                </div>
            </form>

            <h3 class="ms-3 mb-3 mt-3">Data Penduduk</h3>
            <table class="table table-striped mb-5">
                <thead class="text-center">
                    <td>ID</td>
                    <td>NIK</td>
                    <td>Nama Penduduk</td>
                    <td>Alamat</td>
                    <td>Tanggal Lahir</td>
                    <td>Agama ID</td>
                    <td>Action</td>
                </thead>
                <tbody class="text-center">
                    <tr v-for="penduduk in allPenduduk" :key="penduduk.id">
                        <td>{{ penduduk.id }}</td>
                        <td>{{ penduduk.nik }}</td>
                        <td>{{ penduduk.nama }}</td>
                        <td>{{ penduduk.alamat }}</td>
                        <td>{{ penduduk.lahir }}</td>
                        <td>{{ penduduk.agama_id }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" @click="edit(penduduk)">Edit</button>
                                <button type="button" class="btn btn-danger" @click="remove(penduduk)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
  
<script>
import axios from 'redaxios';

export default {
    name: 'penduduk',
    data() {
        return {
            allPenduduk: {},
            penduduk: {
                'id': '',
                'nik': '',
                'nama': '',
                'alamat': '',
                'lahir': '',
                'agama_id': ''
            },
            allAgama: {},
            agama: {
                'id': '',
                'agama': ''
            }
        };
    },
    created() {
        console.log('Created!');
        this.loadAllPenduduk();
        this.loadAllAgama();
    },
    methods: {
        loadAllPenduduk() {
            var url = 'http://127.0.0.1:8000/api/penduduk';
            axios.get(url).then(({ data }) => {
                console.log(data);
                this.allPenduduk = data;
            });
        },
        loadAllAgama() {
            var url = 'http://127.0.0.1:8000/api/agama';
            axios.get(url).then(({ data }) => {
                console.log(data);
                this.allAgama = data;
            });
        },
        remove(penduduk) {
            var url = `http://127.0.0.1:8000/api/penduduk/${penduduk.id}`;
            axios.delete(url).then(() => {
                console.log('Berhasil dihapus !');
                this.loadAllPenduduk();
                this.loadAllAgama();
            });
        },
        edit(penduduk) {
            var url = `http://127.0.0.1:8000/api/penduduk/${penduduk.id}`;
            axios.get(url).then(({ data }) => {
                this.penduduk = data;
                console.log(this.penduduk);
            });
        },
        simpan() {
            if (this.penduduk.id === '') {
                //simpan baru
                var url = 'http://127.0.0.1:8000/api/penduduk';
                axios.post(url, this.penduduk).then(() => {
                    console.log('Berhasil di simpan !');
                    this.loadAllPenduduk();
                    this.loadAllAgama();
                    this.clear();
                });
            } else {
                //simpan lama
                var url = `http://127.0.0.1:8000/api/penduduk/${this.penduduk.id}`;
                axios.put(url, this.penduduk).then(() => {
                    console.log('Berhasil di edit !');
                    this.loadAllPenduduk();
                    this.loadAllAgama();
                    this.clear();
                });
            }
        },
        clear() {
            this.penduduk.id = '';
            this.penduduk.nik = '';
            this.penduduk.nama = '';
            this.penduduk.alamat = '';
            this.penduduk.lahir = '';
            this.penduduk.agama_id = '';
        }
    }
}
</script>