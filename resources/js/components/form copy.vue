<template>
    <v-container>
        <v-row>
            <v-col col="12" lg="5" md="8" sm="12" class="m-auto">
                <v-card class="p-3">
                    <h5>اطلاعات مدارک پزشکی</h5>

                    <v-form fast-fail @submit.prevent="submit">
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
                            <h6>بارگذاری مدارک پزشکی</h6>
                        </v-card-text>

                        <v-card-text>
                            <v-btn
                                size="large"
                                :loading="isLoading"
                                block
                                type="submit"
                                rounded
                                text-color="white"
                                class="w-100"
                                :disabled="v$.$invalid || isLoading"
                                color="primary"
                                >ثبت</v-btn>
                        </v-card-text>
                    </v-form>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
import { ref } from 'vue'
import { useVuelidate } from '@vuelidate/core'
import { required } from '@vuelidate/validators'
import { handleServerErrors } from './../utils/validation'
import api from '@/api'
import DatePicker from './Datepicker.vue'

const isLoading = ref(false);

const data = ref({
    title: '',
    description: '',
    degree_date: ''
})

const rules = {
    title: { required },
    description: { required },
    degree_date: { required }
}

const v$ = useVuelidate(rules, data.value);


const fetchData = async ()=> {
    let response = await api.get('/document');
    data.value = response?.info;
}

fetchData();

const submit = async () => {
  const isValid = await v$.value.$validate()

  if (isValid) {
    try {
        await api.post('/document', data.value)
    } catch (error) {
        handleServerErrors(error)
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
