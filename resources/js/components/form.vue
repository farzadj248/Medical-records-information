<template>
    <v-container>
        <v-row>
            <v-col col="12" lg="5" md="8" sm="12" class="m-auto">
                <v-card class="p-3">
                    <h5>اطلاعات مدارک پزشکی</h5>

                    <v-form fast-fail @submit.prevent>
                        <v-card-text class="mt-3 d-rtl text-right">
                            <v-text-field
                                v-model="data.title"
                                label="عنوان بیماری یا مدرک پزشکی"
                                density="comfortable"
                                hide-details="auto"
                                variant="outlined"
                                color="primary"
                                placeholder="عنوان بیماری یا مدرک پزشکی را وارد کنید"
                            ></v-text-field>
                        </v-card-text>

                        <v-card-text>
                            <v-textarea
                                v-model="data.description"
                                label="توضیحات خودتون رو اینجا بنویسید"
                                row-height="30"
                                rows="8"
                                density="comfortable"
                                hide-details="auto"
                                variant="outlined"
                                color="primary"
                                rounded="16"
                                auto-grow
                            ></v-textarea>
                        </v-card-text>

                        <v-card-text>
                            <DatePicker label="تاریخ مدرک پزشکی" :modelValue="data.degree_date" @update:modelValue="(e)=> data.degree_date = e"/>
                        </v-card-text>

                        <v-card-text>
                            <UserDocuments :files="files"/>
                        </v-card-text>

                        <v-card-text>
                            <v-btn
                                size="large"
                                :loading="isLoading"
                                :disabled="isLoading"
                                block
                                type="submit"
                                rounded
                                text-color="white"
                                class="w-100"
                                color="primary"
                                @click="submit"
                                >ثبت</v-btn>
                        </v-card-text>
                        <ErrorsComponent :errors="errors"/>
                    </v-form>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
import { ref } from 'vue'
import api from '@/api'
import { miladiToJalali,
    jalaliToMiladi } from '@/helpers/index.js'
import { toast } from 'vue3-toastify';

import DatePicker from './Datepicker.vue'
import UserDocuments from './UserDocuments.vue'
import ErrorsComponent from './ErrorsComponent.vue'

const isLoading = ref(false);

const errors = ref([]);

const data = ref({
    title: '',
    description: '',
    degree_date: ''
})

const files = ref(null);

const fetchData = async ()=> {
    let response = await api.get('/document');
    data.value = response;
    data.value.degree_date = miladiToJalali(response.degree_date);
    files.value = response?.media
}

fetchData();

const submit = async () => {
  const isValid = true // for validation later.
  errors.value = [];

  if (isValid) {
    try {
        const response = await api.post('/document', {
            title: data.value.title,
            description: data.value.description,
            degree_date: jalaliToMiladi(data.value.degree_date)
        })
        toast(response?.message || '', {
            "theme": "auto",
            "type": "success",
            "position": "top-center",
            "autoClose": 5000,
            "dangerouslyHTMLString": true
        })
    } catch (error) {
        if (error.response && error.response.status === 422) {
            const serverErrors = error.response.data.message
            for (const [field, messages] of Object.entries(serverErrors)) {
                for (const key in messages) {
                    const message = messages[key];
                    errors.value.push(message);
                }
            }
        }
    }
  }
}
</script>

<style scoped>
h5 {
    font-size: 16px;
    text-align: center;
}
</style>
