<template>
    <div class="container">
        <h1 class="text-center mt-3">Anggota Kartu Keluarga</h1>
        <div class="card mb-5">
            <h3 class="ms-3 mb-3 mt-3">Form Anggota Kartu Keluarga</h3>
            <form @submit.prevent="simpan()">
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Kartu Keluarga ID</label>
                    <select v-model="anggotakk.kk_id" class="form-control">
                        <option v-for="kk in allKk" :key="kk.id" :value="kk.id">{{ kk.nokk }}</option>
                    </select>
                </div>
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Penduduk ID</label>
                    <select v-model="anggotakk.penduduk_id" class="form-control">
                        <option v-for="penduduk in allPenduduk" :key="penduduk.id" :value="penduduk.id">
                            {{ penduduk.nama }}
                        </option>
                    </select>
                </div>
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Hubungan Kartu Keluarga ID</label>
                    <select v-model="anggotakk.hubungankk_id" class="form-control">
                        <option v-for="hubungankk in allHubungankk" :key="hubungankk.id" :value="hubungankk.id">
                            {{ hubungankk.hubungankk }}
                        </option>
                    </select>
                </div>
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Status Aktif</label>
                    <select v-model="anggotakk.statusaktif" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>User ID</label>
                    <select v-model="anggotakk.user_id" class="form-control">
                        <option :value="allUser.id">{{ allUser.name }}</option>
                    </select>
                </div>
                <div class="btn-group mb-5 ms-3 me-3">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-warning" type="button" @click="clear()">Clear</button>
                </div>
            </form>

            <h3 class="ms-3 mb-3 mt-3">Data Anggota Kartu Keluarga</h3>
            <table class="table table-striped mb-5">
                <thead class="text-center">
                    <td>ID</td>
                    <td>Kartu Keluarga ID</td>
                    <td>Penduduk ID</td>
                    <td>Hubungan KK ID</td>
                    <td>Status Aktif</td>
                    <td>User ID</td>
                    <td>Action</td>
                </thead>
                <tbody class="text-center">
                    <tr v-for="anggotakk in allAnggotakk" :key="anggotakk.id">
                        <td>{{ anggotakk.id }}</td>
                        <td>{{ anggotakk.kk_id }}</td>
                        <td>{{ anggotakk.penduduk_id }}</td>
                        <td>{{ anggotakk.hubungankk_id }}</td>
                        <td>{{ anggotakk.statusaktif }}</td>
                        <td>{{ anggotakk.user_id }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" @click="edit(anggotakk)">Edit</button>
                                <button type="button" class="btn btn-danger" @click="remove(anggotakk)">Delete</button>
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
    name: 'anggotakk',
    data() {
        return {
            allAnggotakk: {},
            anggotakk: {
                'id': '',
                'kk_id': '',
                'penduduk_id': '',
                'hubungankk_id': '',
                'statusaktif': '',
                'user_id': ''
            },
            allKk: {},
            kk: {
                'id': '',
                'nokk': '',
                'statusaktif': ''
            },
            allPenduduk: {},
            penduduk: {
                'id': '',
                'nik': '',
                'nama': '',
                'alamat': '',
                'lahir': '',
                'agama_id': ''
            },
            allHubungankk: {},
            hubungankk: {
                'id': '',
                'hubungankk': ''
            },
            allUser: {},
            user: {
                'name': '',
                'email': '',
                'password': '',
                'confirm_password': ''
            }
        };
    },
    created() {
        console.log('Created !');
        this.loadAllAnggotakk();
        this.loadAllKk();
        this.loadAllPenduduk();
        this.loadAllHubungankk();
        this.loadAllUser();
    },
    methods: {
        loadAllAnggotakk() {
            var url = 'http://127.0.0.1:8000/api/anggotakk';
            axios.get(url).then(
                ({ data }) => {
                    console.log(data);
                    this.allAnggotakk = data;
                }
            );
        },
        loadAllKk() {
            var url = `http://127.0.0.1:8000/api/kk`;
            axios.get(url).then(
                ({ data }) => {
                    console.log(data);
                    this.allKk = data;
                }
            );
        },
        loadAllPenduduk() {
            var url = 'http://127.0.0.1:8000/api/penduduk';
            axios.get(url).then(
                ({ data }) => {
                    console.log(data);
                    this.allPenduduk = data;
                }
            );
        },
        loadAllHubungankk() {
            var url = `http://127.0.0.1:8000/api/hubungankk`;
            axios.get(url).then(
                ({ data }) => {
                    console.log(data);
                    this.allHubungankk = data;
                }
            );
        },
        loadAllUser() {
            var url = `http://127.0.0.1:8000/api/user`;
            axios.get(url).then(
                ({ data }) => {
                    console.log(data);
                    this.allUser = data;
                }
            );
        },
        remove(anggotakk) {
            var url = `http://127.0.0.1:8000/api/anggotakk/${anggotakk.id}`;
            axios.delete(url).then(() => {
                console.log('Berhasil dihapus !');
                this.loadAllAnggotakk();
                this.loadAllKk();
                this.loadAllPenduduk();
                this.loadAllHubungankk();
                this.loadAllUser();
            });
        },
        edit(anggotakk) {
            var url = `http://127.0.0.1:8000/api/anggotakk/${anggotakk.id}`;
            axios.get(url).then(({ data }) => {
                this.anggotakk = data;
                console.log(this.anggotakk);
            });
        },
        simpan() {
            if (this.anggotakk.id === '') {
                //simpan baru
                var url = 'http://127.0.0.1:8000/api/anggotakk';
                this.anggotakk.user_id = this.allUser.id;
                axios.post(url, this.anggotakk).then(() => {
                    console.log('Berhasil di simpan !');
                    this.loadAllAnggotakk();
                    this.loadAllKk();
                    this.loadAllPenduduk();
                    this.loadAllHubungankk();
                    this.loadAllUser();
                    this.clear();
                });
            } else {
                //simpan lama
                var url = `http://127.0.0.1:8000/api/anggotakk/${this.anggotakk.id}`;
                axios.put(url, this.anggotakk).then(() => {
                    console.log('Berhasil di edit !');
                    this.loadAllAnggotakk();
                    this.loadAllKk();
                    this.loadAllPenduduk();
                    this.loadAllHubungankk();
                    this.loadAllUser();
                    this.clear();
                });
            }
        },
        clear() {
            this.penduduk.id = '';
            this.penduduk.kk_id = '';
            this.penduduk.penduduk_id = '';
            this.penduduk.hubungankk_id = '';
            this.penduduk.statusaktif = '';
            this.penduduk.user_id = '';
        }
    }
}
</script>