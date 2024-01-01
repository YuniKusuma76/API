<template>
    <div class="container">
        <h1 class="text-center mt-3">Hubungan Kartu Keluarga</h1>
        <div class="card mb-5">
            <h3 class="ms-3 mb-3 mt-3">Form Hubungan Kartu Keluarga</h3>
            <form @submit.prevent="simpan()">
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Hubungan Kartu Keluarga</label>
                    <input type="text" class="form-control" v-model="hubungankk.hubungankk">
                </div>
                <div class="btn-group mb-5 ms-3 me-3">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-warning" type="button" @click="clear()">Clear</button>
                </div>
            </form>

            <h3 class="ms-3 mb-3 mt-3">Data Hubungan Kartu Keluarga</h3>
            <table class="table table-striped mb-5">
                <thead class="text-center">
                    <td>ID</td>
                    <td>Hubungan Kartu Keluarga</td>
                    <td>Action</td>
                </thead>
                <tbody class="text-center">
                    <tr v-for="hubungankk in allHubungankk" :key="hubungankk.id">
                        <td>{{ hubungankk.id }}</td>
                        <td>{{ hubungankk.hubungankk }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" @click="edit(hubungankk)">Edit</button>
                                <button type="button" class="btn btn-danger" @click="remove(hubungankk)">Delete</button>
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
    name: 'hubungankk',
    data() {
        return {
            allHubungankk: {},
            hubungankk: {
                'id': '',
                'hubungankk': ''
            }
        }
    },
    created() {
        console.log('Created !');
        this.loadAllHubungankk();
    },
    mounted() {
        console.log('Mounted');
    },
    methods: {
        loadAllHubungankk() {
            var url = `http://127.0.0.1:8000/api/hubungankk`;
            axios.get(url).then(
                ({ data }) => {
                    console.log(data);
                    this.allHubungankk = data;
                }
            );
        },
        remove(hubungankk) {
            var url = `http://127.0.0.1:8000/api/hubungankk/${hubungankk.id}`;
            axios.delete(url).then(
                () => {
                    console.log('Berhasil dihapus !');
                    this.loadAllHubungankk();
                }
            );
        },
        edit(hubungankk) {
            var url = `http://127.0.0.1:8000/api/hubungankk/${hubungankk.id}`;
            axios.get(url).then(
                ({ data }) => {
                    this.hubungankk = data;
                    console.log(this.hubungankk);
                }
            );
        },
        simpan() {
            if (this.hubungankk.id === '') {
                //simpan baru
                var url = `http://127.0.0.1:8000/api/hubungankk`;
                axios.post(url, this.hubungankk).then(
                    () => {
                        console.log('Berhasil di simpan !');
                        this.loadAllHubungankk();
                        this.clear()
                    }
                );
            } else {
                //simpan lama
                var url = `http://127.0.0.1:8000/api/hubungankk/${this.hubungankk.id}`;
                axios.put(url, this.hubungankk).then(
                    () => {
                        console.log('Berhasil di edit !');
                        this.loadAllHubungankk();
                        this.clear();
                    }
                );
            }
        },
        clear() {
            this.hubungankk.id = '';
            this.hubungankk.hubungankk = '';
        }
    }
}
</script>