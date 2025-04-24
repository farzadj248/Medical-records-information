<template>
    <div class="d-flex flex-column align-center">
        <div class="avatar-container">
            <div
                class="drop-zone"
                :class="{ 'drop-active': isDragging }"
                @dragover.prevent="handleDragOver"
                @dragleave="handleDragLeave"
                @drop.prevent="handleDrop"
                @click="triggerFileInput"
                >
                <div
                    size="150"
                    class="mb-4 elevation-4 avatar-clickable">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_66_10" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="7" width="18" height="12">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.66699 7.32841H18.3333V18.7817H1.66699V7.32841Z" fill="#8AC33E"/>
                        </mask>
                        <g mask="url(#mask0_66_10)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6378 18.7817H5.36283C3.32533 18.7817 1.66699 17.1242 1.66699 15.0859V11.0234C1.66699 8.98591 3.32533 7.32841 5.36283 7.32841H6.14033C6.48533 7.32841 6.76533 7.60841 6.76533 7.95341C6.76533 8.29841 6.48533 8.57841 6.14033 8.57841H5.36283C4.01366 8.57841 2.91699 9.67508 2.91699 11.0234V15.0859C2.91699 16.4351 4.01366 17.5317 5.36283 17.5317H14.6378C15.9862 17.5317 17.0837 16.4351 17.0837 15.0859V11.0159C17.0837 9.67175 15.9903 8.57841 14.647 8.57841H13.8612C13.5162 8.57841 13.2362 8.29841 13.2362 7.95341C13.2362 7.60841 13.5162 7.32841 13.8612 7.32841H14.647C16.6795 7.32841 18.3337 8.98258 18.3337 11.0159V15.0859C18.3337 17.1242 16.6753 18.7817 14.6378 18.7817Z" fill="#527524"/>
                        </g>
                        <mask id="mask1_66_10" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="9" y="1" width="2" height="12">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.375 1.66675H10.625V12.9508H9.375V1.66675Z" fill="#8AC33E"/>
                        </mask>
                        <g mask="url(#mask1_66_10)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 12.9508C9.655 12.9508 9.375 12.6708 9.375 12.3258V2.29167C9.375 1.94667 9.655 1.66667 10 1.66667C10.345 1.66667 10.625 1.94667 10.625 2.29167V12.3258C10.625 12.6708 10.345 12.9508 10 12.9508Z" fill="#527524"/>
                        </g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.57084 5.35725C7.41167 5.35725 7.25167 5.29642 7.13001 5.17475C6.88584 4.93142 6.88417 4.53642 7.12834 4.29142L9.55751 1.85142C9.79167 1.61559 10.2083 1.61559 10.4425 1.85142L12.8725 4.29142C13.1158 4.53642 13.115 4.93142 12.8708 5.17475C12.6258 5.41809 12.2308 5.41809 11.9875 5.17309L10 3.17809L8.01334 5.17309C7.89167 5.29642 7.73084 5.35725 7.57084 5.35725Z" fill="#527524"/>
                    </svg>
                    <p>انتخاب فایل</p>
                </div>
                <div v-if="isDragging" class="drop-hint">
                    فایل رو بکشید و اینجا رها کنید
                </div>
            </div>
        </div>

        <input
            ref="fileInput"
            type="file"
            accept="image/*"
            style="display: none"
            @change="handleInputChange"
        >

        <div v-if="errorMessages.length > 0" class="error-messages mt-2">
            <v-alert
                v-for="(error, index) in errorMessages"
                :key="index"
                dense
                type="error"
                class="mb-1">
            {{ error }}
            </v-alert>
        </div>
    </div>
</template>

<script setup>
    import { ref ,watch } from 'vue'
    import api from '@/api'
    import { toast } from 'vue3-toastify';

    const props = defineProps({
        uploadUrl: {
            type: String,
            required: true
        },
    });

    const file = ref(null)
    const isDragging = ref(false)
    const errorMessages = ref([])
    const fileInput = ref(null)

    const emit = defineEmits(['update:modelValue'])

    const triggerFileInput = () => {
        fileInput.value.click()
    }

    const handleInputChange = (e) => {
        const selectedFile = e.target.files[0]
        if (selectedFile) {
            file.value = selectedFile
            validateAndPreviewFile(selectedFile)
        }
    }

    const handleDragOver = () => {
        isDragging.value = true
    }

    const handleDragLeave = () => {
        isDragging.value = false
    }

    const handleDrop = (e) => {
        isDragging.value = false
        const droppedFile = e.dataTransfer.files[0]

        if (droppedFile) {
            file.value = droppedFile
            validateAndPreviewFile(droppedFile)
        }
    }

    const validateAndPreviewFile = (file) => {
        errorMessages.value = []

        const validTypes = ['image/jpeg', 'image/png', 'image/gif']
        if (!validTypes.includes(file.type)) {
            errorMessages.value.push('فرمت‌های مجاز: image/jpeg,image/png,image/gif')
            return
        }

        if (file.size > 2000000) {
            errorMessages.value.push('حجم مجاز: 2 MB')
            return
        }

        const reader = new FileReader()
        reader.onload = (e) => {
            uploadFile();
        }
        reader.readAsDataURL(file)
    }

    const uploadFile = async() => {
        const fd = new FormData();
        fd.append('file',file.value);
        try {
            const response  = await api.post(props.uploadUrl ,fd ,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            emit('update:modelValue', response.data);
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
</script>

<style scoped>
  .avatar-container {
    position: relative;
    display: inline-block;
  }

  .v-avatar {
    transition: all 0.3s ease;
  }

  .avatar-clickable {
    cursor: pointer;
  }

  .drop-zone {
    position: relative;
    height: 76px;
    padding: 20px;
    border-radius: 16px;
    border:  1px dashed #8AC33E;
    color: #8AC33E;
    text-align: center;
    background-color: #E7F3D8;
  }

  .drop-active {
    background-color: rgba(33, 150, 243, 0.1);
    border: 2px dashed #2196F3;
  }

  .drop-hint {
    position: absolute;
    bottom: -30px;
    left: 0;
    right: 0;
    text-align: center;
    color: #2196F3;
    font-weight: bold;
  }

  .error-messages {
    width: 100%;
    max-width: 300px;
  }
  </style>
