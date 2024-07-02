<template>
  <div class="container mx-auto px-4 py-8 text-xs">
    <div class="flex-r items-center mb-4 justify-between">
      <h1 class="text-2xl font-bold">Suites List</h1>
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
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Vessel Id</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Suite Type</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Price</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Bed</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Bathroom</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Suite size (m²)</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Sundeck size (m²)</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Occupancy (adult)</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Occupancy (children)</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Created at</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Updated at</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in datas" :key="data.id">
            <td class="border px-4 py-2">{{ data.id }}</td>
            <td class="border px-4 py-2">{{ data.title }}</td>
            <td class="border px-4 py-2">{{ data.vessel_id }}</td>
            <td class="border px-4 py-2">
              {{ data.suite_type }}
            </td>
            <td class="border px-4 py-2">
              {{ data.price }}
            </td>
            <td class="border px-4 py-2">
              {{ data.bed_number }}
            </td>
            <td class="border px-4 py-2">
              {{ data.number_of_bathroom }}
            </td>
            <td class="border px-4 py-2">
              {{ data.suite_size }}
            </td>
            <td class="border px-4 py-2">
              {{ data.sundeck_size }}
            </td>
            <td class="border px-4 py-2">
              {{ data.number_of_adult }}
            </td>
            <td class="border px-4 py-2">
              {{ data.number_of_children }}
            </td>
            <td class="border px-4 py-2">{{ formatDateTime(data.created_at) }}</td>
            <td class="border px-4 py-2">{{ formatDateTime(data.updated_at) }}</td>
            <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
              <button @click="
                openEditForm(
                  data.vessel_id,
                  data.id,
                  data.title,
                  data.content,
                  data.bed_number,
                  data.suite_size,
                  data.sundeck_size,
                  data.number_of_adult,
                  data.number_of_bathroom,
                  data.number_of_children,
                  data.price,
                  data.suite_type_id
                )
                " class="bg-blue-500 text-white px-2 py-1 rounded">
                Edit
              </button>
              <button @click="deleteSuite(data.vessel_id, data.id)" class="bg-red-500 text-white px-2 py-1 rounded">
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

  <!-- Add Suite Form -->
  <div v-if="isFormOpen"
    class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center">
    <div class="add-form bg-white rounded p-4 overflow-scroll">
      <h2 class="text-xl font-bold pb-2">Add New Suite</h2>
      <form @submit.prevent="addSuite" class="flex flex-col justify-between">
        <div class="grid grid-cols-2 gap-8">
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
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full">Title</label>
              <input type="text" v-model="form.title" class="form-input" style="width: 100%" />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full">Price</label>
              <input type="text" v-model="form.price" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full"> Suite Size (m²)</label>
              <input type="text" v-model="form.suite_size" class="form-input" style="width: 100%" />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full"> Sundeck Size (m²)</label>
              <input type="text" v-model="form.sundeck_size" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full"> Beds</label>
              <input type="text" v-model="form.bed_number" class="form-input" style="width: 100%" />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full"> Bathroom</label>
              <input type="text" v-model="form.number_of_bathroom" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full"> Occupancy (children)</label>
              <input type="text" v-model="form.number_of_children" class="form-input" style="width: 100%" />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full"> Occupancy (adult)</label>
              <input type="text" v-model="form.number_of_adult" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="mb-2 w-full">
            <label class="block w-full"> Suite type (id)</label>
            <input type="text" v-model="form.suite_type_id" class="form-input" style="width: 100%" />
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
            Add Sutie
          </button>
          <button type="button" @click="closeForm" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- Update Suite Form -->
  <div v-if="isFormEditOpen"
    class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center">
    <div class="add-form bg-white rounded p-4 overflow-scroll">
      <h2 class="text-xl font-bold pb-2">Update Suite</h2>
      <form @submit.prevent="updateSuite" class="flex flex-col justify-between">
        <div class="grid grid-cols-2 gap-8">
          <!-- <div class="">
                        <select @change="handleSelect">
                            <option value="" disabled selected>Select a vessel</option>
                            <option :value="index.id" v-for="index in vessels" :key="index">{{
                                index.name }}</option>
                        </select>
                    </div> -->
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full">Title</label>
              <input type="text" v-model="formEdit.title" class="form-input" style="width: 100%" />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full">Price</label>
              <input type="text" v-model="formEdit.price" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full"> Suite Size (m²)</label>
              <input type="text" v-model="formEdit.suite_size" class="form-input" style="width: 100%" />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full"> Sundeck Size (m²)</label>
              <input type="text" v-model="formEdit.sundeck_size" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full"> Beds</label>
              <input type="text" v-model="formEdit.bed_number" class="form-input" style="width: 100%" />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full"> Bathroom</label>
              <input type="text" v-model="formEdit.number_of_bathroom" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full"> Occupancy (children)</label>
              <input type="text" v-model="formEdit.number_of_children" class="form-input" style="width: 100%" />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full"> Occupancy (adult)</label>
              <input type="text" v-model="formEdit.number_of_adult" class="form-input" style="width: 100%" />
            </div>
          </div>
          <div class="mb-2 w-full">
            <label class="block w-full"> Suite type (id) </label>
            <input type="text" v-model="formEdit.suite_type_id" class="form-input" style="width: 100%" />
          </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
          <div class="mb-2 w-full">
            <label class="block w-full">Content</label>
            <ckeditor :editor="editor" v-model="this.formEdit.content" :config="editorConfig"></ckeditor>
          </div>
        </div>

        <div class="flex-r">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Update Suite
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
import SuiteMetadataService from "@/services/suite.metadata.service";
import SuiteService from "@/services/suite.service";
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
  name: "SuitePortal",
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
      vessel_id: "",
      form: {
        title: "",
        content: "",
        bed_number: "",
        suite_size: "",
        sundeck_size: "",
        number_of_adult: "",
        number_of_bathroom: "",
        number_of_children: "",
        price: "",
        suite_type_id: "",
        language: "EN",
      },
      vessel_id_edit: "",
      suite_id: "",
      formEdit: {
        title: "",
        content: "",
        bed_number: "",
        suite_size: "",
        sundeck_size: "",
        number_of_adult: "",
        number_of_bathroom: "",
        number_of_children: "",
        price: "",
        suite_type_id: "",
        language: "EN",
      },
      imageUrl: "",
    };
  },
  mounted() {
    this.getSuiteData();
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
    updateData(newValue) {
      this.formEdit.content = newValue;
    },
    async getVesselData() {
      const response = await Admin.getVesselData();
      console.log(response.data.data.vessels);
      this.vessels = response.data.data.vessels;
    },
    async getSuiteData() {
      const response = await Admin.getSuiteData();
      this.datas = response.data.data.suites;
      console.log(this.datas);
    },
    async deleteSuite(vessel_id, id) {
      try {
        await Admin.deleteSuite(vessel_id, id);
        this.getSuiteData();
        alert("Delete Successfully");
      } catch (error) {
        alert(error);
      }
    },
    //Add function
    openForm() {
      this.isFormOpen = true;
    },
    closeForm() {
      this.isFormOpen = false;
      this.isFormEditOpen = false;
    },
    handleSelect(event) {
      const vesselId = event.target.value;
      if (vesselId) {
        this.vessel_id = vesselId;
      }
      console.log(this.vessel_id);
    },
    async addSuite() {
      try {
        await SuiteService.storeData(this.form, this.vessel_id).then(() => {
          alert("Add Suite Successfully");
          this.getSuiteData();
        });
      } catch (error) {
        console.log(error);
      }
    },
    //Update function
    openEditForm(
      vessel_id,
      id,
      title,
      content,
      bed_number,
      suite_size,
      sundeck_size,
      number_of_adult,
      number_of_bathroom,
      number_of_children,
      price,
      suite_type_id
    ) {
      this.isFormEditOpen = true;
      this.formEdit.title = title;
      this.formEdit.content = content;
      this.formEdit.bed_number = bed_number;
      this.formEdit.suite_size = suite_size;
      this.formEdit.sundeck_size = sundeck_size;
      this.formEdit.number_of_adult = number_of_adult;
      this.formEdit.number_of_children = number_of_children;
      this.formEdit.number_of_bathroom = number_of_bathroom;
      this.formEdit.price = price;
      this.formEdit.suite_type_id = suite_type_id;
      this.vessel_id_edit = vessel_id;
      this.suite_id = id;
    },
    async updateSuite() {
      try {
        // await Admin.updateSuite(this.vessel_id_edit, this.suite_id, this.formEdit);
        // this.getSuiteData();
        // alert("Update Suite Successfully");
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
      this.suite_id = id;
      this.isFormUploadImageOpen = true;
      await SuiteMetadataService.getData(id)
        .then((res) => {
          this.metadata = res.data.data.suite_metadata;
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

        await SuiteMetadataService.storeData(this.suite_id, response.data.secure_url).then(
          async () => {
            alert("Add Image Successfully!");
            await SuiteMetadataService.getData(this.suite_id)
              .then((res) => {
                this.metadata = res.data.data.suite_metadata;
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
      await SuiteMetadataService.deleteData(id, this.suite_id)
        .then(async () => {
          alert("Delete successfully!");
          const res = await SuiteMetadataService.getData(this.suite_id);
          this.metadata = res.data.data.suite_metadata;
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
