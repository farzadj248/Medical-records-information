<template>
    <div class="section_title mb-4 mt-2"><span></span><h6>بارگذاری مدارک پزشکی</h6></div>
    <FilePicker @update:modelValue="selectFile" uploadUrl="/document/uploadFile"/>

    <v-row class="mt-3">
        <v-col col="12" md="12" class="file_element mb-2 py-0" v-for="(file,i) in files" :key="i">
            <div class="content">
                <v-row>
                    <v-col col="4" md="4" class="text-right">
                        <span @click="removeFile(file)">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 6.10833C17.4833 6.10833 17.4583 6.10833 17.4333 6.10833C13.025 5.66667 8.62499 5.5 4.26666 5.94167L2.56666 6.10833C2.21666 6.14167 1.90832 5.89167 1.87499 5.54167C1.84166 5.19167 2.09166 4.89167 2.43332 4.85833L4.13332 4.69167C8.56666 4.24167 13.0583 4.41667 17.5583 4.85833C17.9 4.89167 18.15 5.2 18.1167 5.54167C18.0917 5.86667 17.8167 6.10833 17.5 6.10833Z" fill="#E54C4C"/>
                                <path d="M7.08332 5.26667C7.04999 5.26667 7.01665 5.26667 6.97499 5.25834C6.64165 5.2 6.40832 4.875 6.46665 4.54167L6.64999 3.45C6.78332 2.65 6.96665 1.54167 8.90832 1.54167H11.0917C13.0417 1.54167 13.225 2.69167 13.35 3.45833L13.5333 4.54167C13.5917 4.88333 13.3583 5.20834 13.025 5.25834C12.6833 5.31667 12.3583 5.08333 12.3083 4.75L12.125 3.66667C12.0083 2.94167 11.9833 2.8 11.1 2.8H8.91665C8.03332 2.8 8.01665 2.91667 7.89165 3.65833L7.69999 4.74167C7.64999 5.05 7.38332 5.26667 7.08332 5.26667Z" fill="#E54C4C"/>
                                <path d="M12.675 19.4583H7.325C4.41666 19.4583 4.3 17.85 4.20833 16.55L3.66666 8.15833C3.64166 7.81667 3.90833 7.51667 4.25 7.49167C4.6 7.475 4.89166 7.73334 4.91666 8.075L5.45833 16.4667C5.55 17.7333 5.58333 18.2083 7.325 18.2083H12.675C14.425 18.2083 14.4583 17.7333 14.5417 16.4667L15.0833 8.075C15.1083 7.73334 15.4083 7.475 15.75 7.49167C16.0917 7.51667 16.3583 7.80833 16.3333 8.15833L15.7917 16.55C15.7 17.85 15.5833 19.4583 12.675 19.4583Z" fill="#E54C4C"/>
                                <path d="M11.3833 14.875H8.60834C8.26667 14.875 7.98334 14.5917 7.98334 14.25C7.98334 13.9083 8.26667 13.625 8.60834 13.625H11.3833C11.725 13.625 12.0083 13.9083 12.0083 14.25C12.0083 14.5917 11.725 14.875 11.3833 14.875Z" fill="#E54C4C"/>
                                <path d="M12.0834 11.5417H7.91669C7.57502 11.5417 7.29169 11.2583 7.29169 10.9167C7.29169 10.575 7.57502 10.2917 7.91669 10.2917H12.0834C12.425 10.2917 12.7084 10.575 12.7084 10.9167C12.7084 11.2583 12.425 11.5417 12.0834 11.5417Z" fill="#E54C4C"/>
                            </svg>
                        </span>
                        <a :href="file.original_url" target="_blank">
                            <span class="mx-3">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 14.1083C8.00833 14.1083 6.39166 12.4917 6.39166 10.5C6.39166 8.50833 8.00833 6.89167 10 6.89167C11.9917 6.89167 13.6083 8.50833 13.6083 10.5C13.6083 12.4917 11.9917 14.1083 10 14.1083ZM10 8.14167C8.7 8.14167 7.64166 9.2 7.64166 10.5C7.64166 11.8 8.7 12.8583 10 12.8583C11.3 12.8583 12.3583 11.8 12.3583 10.5C12.3583 9.2 11.3 8.14167 10 8.14167Z" fill="#00997D"/>
                                    <path d="M9.99999 18.0167C6.86666 18.0167 3.90833 16.1833 1.87499 13C0.991661 11.625 0.991661 9.38333 1.87499 8C3.91666 4.81667 6.87499 2.98333 9.99999 2.98333C13.125 2.98333 16.0833 4.81667 18.1167 8C19 9.375 19 11.6167 18.1167 13C16.0833 16.1833 13.125 18.0167 9.99999 18.0167ZM9.99999 4.23333C7.30833 4.23333 4.73333 5.85 2.93333 8.675C2.30833 9.65 2.30833 11.35 2.93333 12.325C4.73333 15.15 7.30833 16.7667 9.99999 16.7667C12.6917 16.7667 15.2667 15.15 17.0667 12.325C17.6917 11.35 17.6917 9.65 17.0667 8.675C15.2667 5.85 12.6917 4.23333 9.99999 4.23333Z" fill="#00997D"/>
                                </svg>
                            </span>
                        </a>
                    </v-col>
                    <v-col col="8" md="8">
                        <span class="text-left d-block">
                            <span class="px-2">{{truncateString(file.name)}}</span>
                            <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="0.5" width="28" height="28" rx="14" fill="#8AC33E"/>
                                <path d="M14 21.6667C10.0467 21.6667 6.83334 18.4533 6.83334 14.5C6.83334 10.5467 10.0467 7.33333 14 7.33333C17.9533 7.33333 21.1667 10.5467 21.1667 14.5C21.1667 18.4533 17.9533 21.6667 14 21.6667ZM14 8.33333C10.6 8.33333 7.83334 11.1 7.83334 14.5C7.83334 17.9 10.6 20.6667 14 20.6667C17.4 20.6667 20.1667 17.9 20.1667 14.5C20.1667 11.1 17.4 8.33333 14 8.33333Z" fill="white"/>
                                <path d="M13.0533 16.8867C12.92 16.8867 12.7933 16.8333 12.7 16.74L10.8133 14.8533C10.62 14.66 10.62 14.34 10.8133 14.1467C11.0067 13.9533 11.3267 13.9533 11.52 14.1467L13.0533 15.68L16.48 12.2533C16.6733 12.06 16.9933 12.06 17.1867 12.2533C17.38 12.4467 17.38 12.7667 17.1867 12.96L13.4067 16.74C13.3133 16.8333 13.1867 16.8867 13.0533 16.8867Z" fill="white"/>
                            </svg>
                        </span>
                    </v-col>
                </v-row>
            </div>
        </v-col>
    </v-row>
</template>

<script setup>
    import { ref ,watch } from 'vue'
    import FilePicker from './FilePicker.vue'
    import api from '@/api'
    import { toast } from 'vue3-toastify';

    const props = defineProps({
        files: {
            type: Array,
            required: true
        },
    });

    const files = ref(props.files);

    watch(()=> props.files,()=> {
        files.value = props.files;
    },{deep: true})

    const selectFile = (file)=> {
        files.value.push(file);
    }

    const removeFile = async(file)=> {
        try {
            const response  = await api.delete(`/document/file/${file.id}/delete`);
            if(response.success) {
                const index = files.value.findIndex(item => item.id === file.id);
                if (index !== -1) {
                    files.value.splice(index, 1);
                }
            }
        } catch (error) {
            toast(error || 'خطا سرور!', {
                "theme": "auto",
                "type": "error",
                "position": "top-center",
                "autoClose": 5000,
                "dangerouslyHTMLString": true
            })
        }
    }

    const truncateString = (str) => {
        if (str.length > 20) {
            return str.substring(0, 20) + '...';
        }
        return str;
    }
</script>

<style scoped>
.section_title {
    position: relative;
    padding-right: 15px;
}
.section_title h6 {
    font-size: 16px
}

.section_title span {
    position: absolute;
    top: -7px;
    right: 0;
    width: 6px;
    height: 34px;
    border-radius: 5px 0 0 5px;
    background-color: #8AC33E;
}

.file_element {
    margin-bottom: 8px
}

.file_element .content {
    position: relative;
    height: 49px;
    padding: 10px 16px;
    border-radius: 16px;
    border:  1px dashed #8AC33E;
    color: #8AC33E;
    text-align: center;
    background-color: #E7F3D8;
}

.file_element .content span {
    cursor: pointer
}
  </style>
