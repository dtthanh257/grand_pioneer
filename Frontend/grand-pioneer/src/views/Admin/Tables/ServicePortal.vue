<template>
  <div class="container mx-auto px-4 py-8 text-xs">
    <div class="flex-c gap-5 mb-5">
      <div class="flex-r items-center mb-4 justify-between">
        <h1 class="text-2xl font-bold">Services List</h1>
        <div class="flex-r font-semibold gap-2 items-center cursor-pointer" @click="openForm">
          <div class="addBtn bg-contain"></div>
          Add new
        </div>
      </div>
      <div class="">
        <select @change="handleSelect">
          <option value="" disabled selected>
            Select a vessel
          </option>
          <option :value="index.id" v-for="index in vessels" :key="index">
            {{ index.name }}
          </option>
        </select>
      </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
      <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
        <thead>
          <tr class="text-left">
            <th class="py-2 px-3 sticky top-0 bg-gray-200">ID</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Title</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Content</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Opening hour</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Location</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Image Link</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Created At</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Updated At</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in datas" :key="data.id">
            <td class="border px-4 py-2">{{ data.id }}</td>
            <td class="border px-4 py-2">{{ data.title }}</td>
            <td class="border px-4 py-2">{{ data.content }}</td>
            <td class="border px-4 py-2">
              {{ data.opening_hour }}
            </td>
            <td class="border px-4 py-2">
              {{ data.location }}
            </td>
            <td class="border px-4 py-2">
              <li v-for="index in data.service_metadatas" :key="index">
                {{ index }}
              </li>
            </td>
            <td class="border px-4 py-2">{{ formatDateTime(data.created_at) }}</td>
            <td class="border px-4 py-2">{{ formatDateTime(data.updated_at) }}</td>
            <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
              <button @click="
                openFormEdit(
                  data.id,
                  data.vessel_id,
                  data.title,
                  data.content,
                  data.opening_hour,
                  data.location
                )
                " class="bg-blue-500 text-white px-2 py-1 rounded">
                Edit
              </button>
              <button @click="deleteService(data.id)" class="bg-red-500 text-white px-2 py-1 rounded">
                Delete
              </button>
              <button class="bg-blue-500 text-white px-2 py-1 rounded" @click="openFormUploadImage(data.id)">
                Add Image
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Add Service Form -->
  <div v-if="isFormOpen"
    class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center">
    <div class="add-form bg-white rounded p-4 overflow-scroll">
      <h2 class="text-xl font-bold pb-2">Add New Service</h2>
      <form @submit.prevent="addService" class="flex flex-col justify-between">
        <div class="grid grid-cols-2 gap-8">
          <div class="">
            <select @change="handleSelectForm">
              <option value="" disabled selected>
                Select a vessel
              </option>
              <option :value="index.id" v-for="index in vessels" :key="index">
                {{ index.name }}
              </option>
            </select>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full">Title</label>
              <input type="text" v-model="form.title" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full">Opening hour</label>
              <input type="text" v-model="form.opening_hour" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full"> Location</label>
              <input type="text" v-model="form.location" class="form-input" style="width: 100%" />
            </div>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
          <div class="mb-2 w-full">
            <label class="block w-full">Content</label>
            <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>
          </div>
        </div>

        <div class="flex-r">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Service
          </button>
          <button type="button" @click="closeForm" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- Form edit -->
  <div v-if="isFormEditOpen"
    class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center">
    <div class="add-form bg-white rounded p-4 overflow-scroll">
      <h2 class="text-xl font-bold pb-2">Add New Service</h2>
      <form @submit.prevent="updateService()" class="flex flex-col justify-between">
        <div class="grid grid-cols-2 gap-8">
          <div class="">
            <select v-model="formEdit.vessel_id" @change="handleSelectEditForm">
              <option :value="index.id" selected v-for="index in vessels" :key="index.id">
                {{ index.name }}
              </option>
            </select>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full">Title</label>
              <input type="text" v-model="formEdit.title" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full">Opening hour</label>
              <input type="text" v-model="formEdit.opening_hour" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full"> Location</label>
              <input type="text" v-model="formEdit.location" class="form-input" style="width: 100%" />
            </div>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
          <div class="mb-2 w-full">
            <label class="block w-full">Content</label>
            <ckeditor :editor="editor" v-model="formEdit.content" :config="editorConfig"></ckeditor>
          </div>
        </div>

        <div class="flex-r">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Update Service
          </button>
          <button type="button" @click="closeForm" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- Upload Image Form -->
  <div class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
    v-if="isFormUploadImageOpen">
    <div class="add-form bg-white rounded p-4 overflow-scroll">
      <h2 class="text-xl font-bold pb-2">Upload Image</h2>
      <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mb-10">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
          <thead>
            <tr class="text-left">
              <th class="py-2 px-3 sticky top-0 bg-gray-200">ID</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Image Link</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in metadata" :key="data.id">
              <td class="border px-4 py-2">{{ data.id }}</td>
              <td class="border px-4 py-2">{{ data.image_link }}</td>
              <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
                <button @click="deleteMetadata(data.id)" class="bg-red-500 text-white px-2 py-1 rounded">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <input type="file" @change="onFileChange" />
      <div class="flex flex-row mt-4">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" @click="uploadImage">
          Upload
        </button>
        <button type="button" @click="closeFormUploadImage" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import Admin from "@/services/admin.service";
import axios from "axios";
import ServiceMetadataService from "@/services/service.metadata.service";
import CKEditor from '@ckeditor/ckeditor5-vue';
import 'ckeditor5/ckeditor5.css';
import {
  ClassicEditor,
  Bold,
  Essentials,
  Heading,
  Indent,
  IndentBlock,
  Italic,
  Link,
  List,
  MediaEmbed,
  Paragraph,
  Table,
  Undo
} from 'ckeditor5';
export default {
  name: "ServicePortal",
  components: {
    ckeditor: CKEditor.component
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        toolbar: [
          'undo', 'redo', '|',
          'heading', '|', 'bold', 'italic', '|',
          'link', 'insertTable', 'mediaEmbed', '|',
          'bulletedList', 'numberedList', 'indent', 'outdent'
        ],
        plugins: [
          Bold,
          Essentials,
          Heading,
          Indent,
          IndentBlock,
          Italic,
          Link,
          List,
          MediaEmbed,
          Paragraph,
          Table,
          Undo
        ],
      },
      datas: [],
      vessels: [],
      metadata: [],
      isFormOpen: false,
      isFormEditOpen: false,
      isFormUploadImageOpen: false,
      form: {
        title: "",
        content: "",
        opening_hour: "",
        location: "",
        language: "EN",
      },
      formEdit: {
        vessel_id: "",
        title: "",
        content: "",
        opening_hour: "",
        location: "",
        language: "EN",
      },
      vesselId: "",
      updateServiceId: "",
      service_id: "",
    };
  },
  mounted() {
    this.getVesselData();
  },
  methods: {
    formatDateTime(datetime) {
      const options = {
        year: "numeric",
        month: "short",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
      };
      return new Date(datetime).toLocaleDateString("en-US", options);
    },
    async getVesselData() {
      const response = await Admin.getVesselData();
      console.log(response.data.data.vessels);
      this.vessels = response.data.data.vessels;
    },
    handleSelect(event) {
      const vesselId = event.target.value;
      if (vesselId) {
        this.getServiceByVessel(vesselId);
      }
      localStorage.setItem("vessel_id", vesselId);
    },
    async getServiceByVessel(vessel_id) {
      try {
        const res = await Admin.getServiceByVessel(vessel_id);
        this.datas = res.data.data.services;
        console.log(this.datas);
      } catch (error) {
        console.log(error);
      }
    },
    async deleteService(id) {
      try {
        const vessel_id = localStorage.getItem("vessel_id");
        await Admin.deleteService(vessel_id, id);
        this.getServiceByVessel(vessel_id);
        alert("Delete Service Successfully");
      } catch (error) {
        alert(error);
      }
    },
    openForm() {
      this.isFormOpen = true;
    },
    closeForm() {
      this.isFormOpen = false;
      this.isFormEditOpen = false;
    },
    handleSelectForm(event) {
      const vesselId = event.target.value;
      if (vesselId) {
        this.vesselId = vesselId;
      }
    },
    async addService() {
      try {
        await Admin.addService(this.vesselId, this.form);
        alert("Add service successfully");
        this.getServiceByVessel(this.vesselId);
      } catch (error) {
        alert(error);
      }
    },
    // Update funcion
    openFormEdit(id, vessel_id, title, content, opening_hour, location) {
      (this.isFormEditOpen = true),
        (this.updateServiceId = id),
        (this.formEdit.vessel_id = vessel_id),
        (this.formEdit.title = title),
        (this.formEdit.content = content),
        (this.formEdit.opening_hour = opening_hour),
        (this.formEdit.location = location),
        (this.formEdit.language = "EN");
      console.log(this.formEdit);
    },
    handleSelectEditForm(event) {
      const vesselId = event.target.value;
      if (vesselId) {
        this.formEdit.vessel_id = vesselId;
        console.log(this.formEdit.vessel_id);
      }
    },
    async updateService() {
      try {
        const vessel_id = localStorage.getItem("vessel_id");
        const serviceId = this.updateServiceId;
        await Admin.updateServiceById(vessel_id, serviceId, this.formEdit);
        this.getServiceByVessel(vessel_id);
        alert("Update Service Successfully");
      } catch (error) {
        console.log(error);
      }
    },

    onFileChange(event) {
      this.selectedFile = event.target.files[0];
    },

    closeFormUploadImage() {
      this.isFormUploadImageOpen = false;
    },
    async openFormUploadImage(id) {
      this.service_id = id;
      this.isFormUploadImageOpen = true;
      await ServiceMetadataService.getData(id)
        .then((res) => {
          this.metadata = res.data.data.service_metadatas;
        })
        .catch((err) => {
          alert(err.data.message);
        });
    },

    async uploadImage() {
      if (!this.selectedFile) {
        alert("Please select a file first");
        return;
      }

      const formData = new FormData();
      formData.append("file", this.selectedFile);
      formData.append("upload_preset", "grand-pioneers"); // Thay 'your_upload_preset' bằng upload preset của bạn

      try {
        const response = await axios.post(
          `https://api.cloudinary.com/v1_1/dfgr5besj/image/upload`, // Thay 'your_cloud_name' bằng cloud name của bạn
          formData
        );

        await ServiceMetadataService.storeData(this.service_id, response.data.secure_url).then(
          async () => {
            alert("Add Image Successfully!");
            await ServiceMetadataService.getData(this.service_id)
              .then((res) => {
                this.metadata = res.data.data.service_metadatas;
              })
              .catch((err) => {
                alert(err.data.message);
              });
          }
        );

        alert("Upload successful!");
      } catch (error) {
        console.error("Error uploading image:", error);
        alert("Upload failed. Please try again.");
      }
    },

    async deleteMetadata(id) {
      await ServiceMetadataService.deleteData(id, this.service_id)
        .then(async () => {
          alert("Remove successfully!");
          await ServiceMetadataService.getData(this.service_id)
            .then((res) => {
              this.metadata = res.data.data.service_metadatas;
            })
            .catch((err) => {
              alert(err.data.message);
            });
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>

<style scoped>
table th,
td {
  white-space: nowrap;
}

.sticky-col {
  position: -webkit-sticky;
  position: sticky;
  right: 0;
  z-index: 2;
  width: fit-content;
}

thead .sticky-col {
  z-index: 5;
}
</style>
