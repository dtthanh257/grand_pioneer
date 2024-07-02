<template>
  <div class="container mx-auto px-4 py-8 text-xs">
    <div class="flex-r items-center mb-4 justify-between">
      <h1 class="text-2xl font-bold">Vessel List</h1>
      <div class="flex-r font-semibold gap-2 items-center cursor-pointer" @click="openForm">
        <div class="addBtn bg-contain"></div>
        Add new
      </div>
    </div>
    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
      <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
        <thead>
          <tr class="text-left">
            <th class="py-2 px-3 sticky top-0 bg-gray-200">ID</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Name</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Status</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Inclusion</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Exclusion</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Created At</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Updated At</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in datas" :key="data.id">
            <td class="border px-4 py-2">{{ data.id }}</td>
            <td class="border px-4 py-2">{{ data.name }}</td>
            <td class="border px-4 py-2">
              {{ data.status == 1 ? "Đang hoạt động" : "Không hoạt động" }}
            </td>
            <td class="border px-4 py-2">
              {{ data.inclusion }}
            </td>
            <td class="border px-4 py-2">
              {{ data.exclusion }}
            </td>
            <td class="border px-4 py-2">{{ formatDateTime(data.created_at) }}</td>
            <td class="border px-4 py-2">{{ formatDateTime(data.updated_at) }}</td>
            <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
              <button @click="editBtn(user)" class="bg-blue-500 text-white px-2 py-1 rounded">
                Edit
              </button>
              <button @click="deleteBtn(data.id, data.name)" class="bg-red-500 text-white px-2 py-1 rounded">
                Delete
              </button>
              <button @click="openFormUploadImage(data.id)" class="bg-blue-500 text-white px-2 py-1 rounded">
                Add Image
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="isFormOpen"
      class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center">
      <div class="add-form bg-white rounded p-4">
        <h2 class="text-xl font-bold pb-2">Add New Vessel</h2>
        <form @submit.prevent="addVessel" class="flex flex-col justify-between">
          <div class="grid grid-cols-2 gap-8">
            <div class="flex-r gap-2">
              <div class="mb-2 w-full">
                <label class="block w-full">Vessel's name</label>
                <input v-model="form.name" type="text" class="form-input" style="width: 100%" />
              </div>
            </div>
            <div class="mb-2 flex-col flex">
              <label class="block mb-1">Status</label>
              <div class="flex-r gap-3">
                <div class="flex-r gap-1">
                  <input type="radio" name="gender" value="0" v-model="form.status" />
                  Actived
                </div>
                <div class="flex-r gap-1">
                  <input type="radio" name="gender" value="1" v-model="form.status" />
                  Deactived
                </div>
                <div class="flex-r gap-1">
                  <input type="radio" name="gender" value="2" v-model="form.status" />
                  Under Maintenance
                </div>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-1">
            <div class="mb-2 w-full">
              <label class="block w-full">Inclusion</label>
              <ckeditor :editor="editor" v-model="form.inclusion" :config="editorConfig"></ckeditor>
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full">Exclusion</label>
              <ckeditor :editor="editor" v-model="form.exclusion" :config="editorConfig"></ckeditor>
            </div>
          </div>

          <div class="flex-r">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
              Add Vessel
            </button>
            <button type="button" @click="closeForm" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
              Cancel
            </button>
          </div>
        </form>
      </div>
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
import VesselMetadataService from "@/services/vessel.metadata.service";
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
  name: "VesselPortal",
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
      form: {
        name: "",
        status: 0,
        inclusion: "",
        exclusion: "",
        language: "EN",
      },
      isFormOpen: false,
      isFormUploadImageOpen: false,
      metadata: [],
      vessel_id: "",
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
      this.datas = response.data.data.vessels;
    },
    openForm() {
      this.isFormOpen = true;
    },
    closeForm() {
      this.isFormOpen = false;
    },
    async addVessel() {
      try {
        await Admin.addVessel(this.form).then((response) => {
          this.getVesselData();
          this.closeForm();
          alert("Add vessel successful");
          console.log(response);
        });
        this.closeForm();
      } catch (error) {
        alert(error.data.message);
      }
    },
    editUser() {
      this.getVesselData();
    },
    deleteBtn(id, name) {
      if (confirm(`Are you sure you want to delete vessel: ${name} ?`)) {
        try {
          Admin.deleteVessel(id);
          this.getVesselData();
        } catch (error) {
          alert(error);
        }
      }
    },

    onFileChange(event) {
      this.selectedFile = event.target.files[0];
    },

    closeFormUploadImage() {
      this.isFormUploadImageOpen = false;
    },
    async openFormUploadImage(id) {
      this.vessel_id = id;
      this.isFormUploadImageOpen = true;
      await VesselMetadataService.getData(id)
        .then((res) => {
          this.metadata = res.data.data.vessel_metadata;
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

        await VesselMetadataService.storeData(this.vessel_id, response.data.secure_url).then(
          async () => {
            alert("Add Image Successfully!");
            await VesselMetadataService.getData(this.vessel_id)
              .then((res) => {
                this.metadata = res.data.data.vessel_metadata;
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
      await VesselMetadataService.deleteData(id, this.vessel_id)
        .then(async () => {
          alert("Delete successfully!");
          const res = await VesselMetadataService.getData(this.vessel_id);
          this.metadata = res.data.data.vessel_metadata;
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
