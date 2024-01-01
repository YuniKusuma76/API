<template>
    <div class="container">
        <h1 class="text-center mt-3">Kartu Keluarga</h1>
        <div class="card mb-5">
            <h3 class="ms-3 mb-3 mt-3">Form Kartu Keluarga</h3>
            <form @submit.prevent="simpan()">
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>NO. Kartu Keluarga</label>
                    <input type="text" class="form-control" v-model="kk.nokk">
                </div>
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Status Aktif</label>
                    <select v-model="kk.statusaktif" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <div class="btn-group mb-5 ms-3 me-3">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-warning" type="button" @click="clear()">Clear</button>
                </div>
            </form>

            <h3 class="ms-3 mb-3 mt-3">Data Kartu Keluarga</h3>
            <table class="table table-striped mb-5">
                <thead class="text-center">
                    <td>ID</td>
                    <td>No. KK</td>
                    <td>Status Aktif</td>
                    <td>Action</td>
                </thead>
                <tbody class="text-center">
                    <tr v-for="kk in allKk" :key="kk.id">
                        <td>{{ kk.id }}</td>
                        <td>{{ kk.nokk }}</td>
                        <td>{{ kk.statusaktif }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" @click="edit(kk)">Edit</button>
                                <button type="button" class="btn btn-danger" @click="remove(kk)">Delete</button>
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
    name: 'kk',
    data() {
        return {
            allKk: {},
            kk: {
                'id': '',
                'nokk': '',
                'statusaktif': ''
            }
        }
    },
    created() {
        console.log('Created !');
        this.loadAllKk();
    },
    mounted() {
        console.log('Mounted');
    },
    methods: {
        loadAllKk() {
            var url = `http://127.0.0.1:8000/api/kk`;
            axios.get(url).then(
                ({ data }) => {
                    console.log(data);
                    this.allKk = data;
                }
            );
        },
        remove(kk) {
            var url = `http://127.0.0.1:8000/api/kk/${kk.id}`;
            axios.delete(url).then(
                () => {
                    console.log('Berhasil dihapus !');
                    this.loadAllKk();
                }
            );
        },
        edit(kk) {
            var url = `http://127.0.0.1:8000/api/kk/${kk.id}`;
            axios.get(url).then(
                ({ data }) => {
                    this.kk = data;
                    console.log(this.kk);
                }
            );
        },
        simpan() {
            if (this.kk.id === '') {
                //simpan baru
                var url = `http://127.0.0.1:8000/api/kk`;
                axios.post(url, this.kk).then(
                    () => {
                        console.log('Berhasil di simpan !');
                        this.loadAllKk();
                        this.clear()
                    }
                );
            } else {
                //simpan lama
                var url = `http://127.0.0.1:8000/api/kk/${this.kk.id}`;
                axios.put(url, this.kk).then(
                    () => {
                        console.log('Berhasil di edit !');
                        this.loadAllKk();
                        this.clear();
                    }
                );
            }
        },
        clear() {
            this.kk.id = '';
            this.kk.nokk = '';
            this.kk.statusaktif = '';
        }
    }
}
</script>