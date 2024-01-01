<template>
    <div class="container">
        <h1 class="text-center mt-3">Agama</h1>
        <div class="card mb-5">
            <h3 class="ms-3 mb-3 mt-3">Form Agama</h3>
            <form @submit.prevent="simpan()">
                <div class="mb-3 ms-3 me-3 form-group">
                    <label>Agama</label>
                    <input type="text" class="form-control" v-model="agama.agama">
                </div>
                <div class="btn-group mb-5 ms-3 me-3">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-warning" type="button" @click="clear()">Clear</button>
                </div>
            </form>

            <h3 class="ms-3 mb-3 mt-3">Data Agama</h3>
            <table class="table table-striped mb-5">
                <thead class="text-center">
                    <td>ID</td>
                    <td>Agama</td>
                    <td>Action</td>
                </thead>
                <tbody class="text-center">
                    <tr v-for="agama in allAgama" :key="agama.id">
                        <td>{{ agama.id }}</td>
                        <td>{{ agama.agama }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" @click="edit(agama)">Edit</button>
                                <button type="button" class="btn btn-danger" @click="remove(agama)">Delete</button>
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
    name: 'agama',
    data() {
        return {
            allAgama: {},
            agama: {
                'id': '',
                'agama': ''
            }
        }
    },
    created() {
        console.log('Created !');
        this.loadAllAgama();
    },
    mounted() {
        console.log('Mounted');
    },
    methods: {
        loadAllAgama() {
            var url = `http://127.0.0.1:8000/api/agama`;
            axios.get(url).then(
                ({ data }) => {
                    console.log(data);
                    this.allAgama = data;
                }
            );
        },
        remove(agama) {
            var url = `http://127.0.0.1:8000/api/agama/${agama.id}`;
            axios.delete(url).then(
                () => {
                    console.log('Berhasil dihapus !');
                    this.loadAllAgama();
                }
            );
        },
        edit(agama) {
            var url = `http://127.0.0.1:8000/api/agama/${agama.id}`;
            axios.get(url).then(
                ({ data }) => {
                    this.agama = data;
                    console.log(this.agama);
                }
            );
        },
        simpan() {
            if (this.agama.id === '') {
                //simpan baru
                var url = `http://127.0.0.1:8000/api/agama`;
                axios.post(url, this.agama).then(
                    () => {
                        console.log('Berhasil di simpan !');
                        this.loadAllAgama();
                        this.clear()
                    }
                );
            } else {
                //simpan lama
                var url = `http://127.0.0.1:8000/api/agama/${this.agama.id}`;
                axios.put(url, this.agama).then(
                    () => {
                        console.log('Berhasil di edit !');
                        this.loadAllAgama();
                        this.clear();
                    }
                );
            }
        },
        clear() {
            this.agama.id = '';
            this.agama.agama = '';
        }
    }
}
</script>