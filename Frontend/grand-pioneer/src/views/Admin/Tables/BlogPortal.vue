<template>
  <div class="container mx-auto px-4 py-8 text-xs">
    <div class="flex-r items-center mb-4 justify-between">
      <h1 class="text-2xl font-bold">Blogs List</h1>
      <div
        class="flex-r font-semibold gap-2 items-center cursor-pointer"
        @click="openBlogForm"
      >
        <div class="addBtn bg-contain"></div>
        Add new
      </div>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
      <table
        class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative"
      >
        <thead>
          <tr class="text-left">
            <th class="py-2 px-3 sticky top-0 bg-gray-200">ID</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Title</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Description</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Thumbnail</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Post Section</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Created At</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200">Updated At</th>
            <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="data in datas"
            :key="data.id"
          >
            <td class="border px-4 py-2">{{ data.id }}</td>
            <td class="border px-4 py-2 min-w-72 max-w-96 text-wrap">{{ data.title }}</td>
            <td class="border px-4 py-2 min-w-72 max-w-96 text-wrap">{{ data.description }}</td>
            <td class="border px-4 py-2 min-w-72 text-wrap">
              {{ data.thumbnail }}
            </td>
            <td class="border px-4 py-2">
              <button
                @click="viewSection(data.id)"
                class="border p-4"
              >
                View Post section
              </button>
            </td>
            <td class="border px-4 py-2">{{ formatDateTime(data.created_at) }}</td>
            <td class="border px-4 py-2">{{ formatDateTime(data.updated_at) }}</td>
            <td class="border px-4 py-2 sticky-col bg-white space-x-2">
              <button
                @click="openUpdateBlogForm(data.title, data.description, data.thumbnail, data.id)"
                class="bg-blue-500 text-white px-2 py-1 rounded"
              >
                Edit
              </button>
              <button
                @click="deleteBlog(data.id)"
                class="bg-red-500 text-white px-2 py-1 rounded"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div
    class="fixed right-0 top-0 left-0 bottom-0 z-10"
    v-if="isSectionView"
    style="background-color: rgba(0, 0, 0, 56%)"
  >
    <div
      class="absolute top-1/2 right-1/2 translate-x-1/2 -translate-y-1/2 z-20 bg-white flex-c gap-8 p-4 whitespace-nowrap"
      style="max-width: 800px; max-height: 800; overflow: scroll"
    >
      <div class="flex-r gap-8">
        <h2 class="font-semibold">Section View</h2>
        <div
          class="flex-r font-semibold gap-2 items-center cursor-pointer"
          @click="openSectionForm()"
          style="top: 0; left: 100%"
        >
          <div class="addBtn bg-contain"></div>
          Add new
        </div>
      </div>
      <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mb-10">
        <table
          class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative"
        >
          <thead>
            <tr class="text-left">
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Id</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Post id</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Section name</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Content</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Image link</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Image name</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Create At</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Update At</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="section in sections"
              :key="section.id"
            >
              <td class="border py-2 px-3 sticky top-0 bg-gray-200">{{ section.id }}</td>
              <td class="border py-2 px-3 sticky top-0 bg-gray-200">{{ section.post_id }}</td>
              <td class="border py-2 px-3 sticky top-0 bg-gray-200">
                {{ section.section_name }}
              </td>
              <td class="border py-2 px-3 sticky top-0 bg-gray-200">
                {{ section.content }}
              </td>
              <td class="border py-2 px-3 sticky top-0 bg-gray-200">{{ section.image_link }}</td>
              <td class="border py-2 px-3 sticky top-0 bg-gray-200">{{ section.image_name }}</td>
              <td class="border py-2 px-3 sticky top-0 bg-gray-200">{{ section.created_at }}</td>
              <td class="border py-2 px-3 sticky top-0 bg-gray-200">{{ section.updated_at }}</td>
              <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
                <button
                  @click="
                    openEditSectionForm(
                      section.section_name,
                      section.content,
                      section.image_link,
                      section.image_name,
                      section.id
                    )
                  "
                  class="bg-blue-500 text-white px-2 py-1 rounded"
                >
                  Edit
                </button>
                <button
                  @click="deletePostSection(section.id)"
                  class="bg-red-500 text-white px-2 py-1 rounded"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="flex-r w-full justify-end">
        <button
          @click="closeSection"
          class="border p-3 hover:bg-slate-400"
        >
          Cancel
        </button>
      </div>
    </div>
  </div>
  <!-- Blog Form -->
  <div
    v-if="isFormOpen"
    class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
  >
    <div class="add-form bg-white rounded p-4">
      <h2 class="text-xl font-bold pb-2">Add New Blog</h2>
      <form
        @submit.prevent="addBlog"
        class="flex flex-col justify-between"
      >
        <div class="grid grid-cols-1 gap-8">
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full">Title</label>
              <input
                type="text"
                v-model="blogForm.title"
                class="form-input"
                style="width: 100%"
              />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full">Thumnail</label>
              <input
                type="text"
                v-model="blogForm.thumbnail"
                class="form-input"
                readonly
                style="width: 100%"
              />
              <input
                type="file"
                @change="onFileChange"
              />
              <div class="flex flex-row mt-4">
                <button
                  type="submit"
                  class="bg-blue-500 text-white px-4 py-2 rounded"
                  @click="uploadImage"
                >
                  Upload
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
          <div class="mb-2 w-full">
            <label class="block w-full">Description</label>
            <textarea
              type="text"
              class="form-input"
              v-model="blogForm.description"
              style="height: 100px"
            ></textarea>
          </div>
          <div class="flex-r gap-3"></div>
        </div>

        <div class="flex-r">
          <button
            type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded"
          >
            Add Blog
          </button>
          <button
            type="button"
            @click="closeBlogForm"
            class="bg-gray-500 text-white px-4 py-2 rounded ml-2"
          >
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Update Blog Form -->
  <div
    v-if="isFormUpdateOpen"
    class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
  >
    <div class="add-form bg-white rounded p-4">
      <h2 class="text-xl font-bold pb-2">Add New Blog</h2>
      <form
        @submit.prevent="updateBlog"
        class="flex flex-col justify-between"
      >
        <div class="grid grid-cols-1 gap-8">
          <div class="flex-r gap-2">
            <div class="mb-2 w-full">
              <label class="block w-full">Title</label>
              <input
                type="text"
                v-model="blogUpdateForm.title"
                class="form-input"
                style="width: 100%"
              />
            </div>
            <div class="mb-2 w-full">
              <label class="block w-full">Thumnail</label>
              <input
                type="text"
                v-model="blogUpdateForm.thumbnail"
                class="form-input"
                readonly
                style="width: 100%"
              />
              <input
                type="file"
                @change="onFileChange"
              />
              <div class="flex flex-row mt-4">
                <button
                  type="submit"
                  class="bg-blue-500 text-white px-4 py-2 rounded"
                  @click="uploadImage"
                >
                  Upload
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-8">
          <div class="mb-2 w-full">
            <label class="block w-full">Description</label>
            <textarea
              type="text"
              class="form-input"
              v-model="blogUpdateForm.description"
              style="height: 100px"
            ></textarea>
          </div>
          <div class="flex-r gap-3"></div>
        </div>

        <div class="flex-r">
          <button
            type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded"
          >
            Update Blog
          </button>
          <button
            type="button"
            @click="closeBlogForm"
            class="bg-gray-500 text-white px-4 py-2 rounded ml-2"
          >
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- Add Section -->
  <div
    class="fixed right-0 top-0 bottom-0 left-0 p-4 z-30"
    style="background-color: rgba(0, 0, 0, 56%)"
    v-if="addsectionForm"
  >
    <div
      class="bg-white absolute right-1/2 top-1/2 translate-x-1/2 -translate-y-1/2 p-4"
      style="max-height: 600px !important; width: 400px; overflow: scroll; overflow-y: scroll"
    >
      <h2>Add Section</h2>
      <div class="flex-c gap-4">
        <div class="flex-c">
          <div class="font-semibold">Section name</div>
          <input
            type="text"
            v-model="sectionForm.section_name"
          />
        </div>
        <div class="flex-c">
          <div class="font-semibold">Content</div>
          <textarea
            type="text"
            v-model="sectionForm.content"
          >
          </textarea>
        </div>
        <div class="flex-c">
          <div class="font-semibold">Image Link</div>
          <input
            type="text"
            v-model="sectionForm.image_link"
            readonly
          />
          <input
            type="file"
            @change="onFileChange"
          />
          <div class="flex flex-row mt-4">
            <button
              type="submit"
              class="bg-blue-500 text-white px-4 py-2 rounded"
              @click="uploadImage"
            >
              Upload
            </button>
          </div>
        </div>
        <div class="flex-c">
          <div class="font-semibold">Image Name</div>
          <input
            type="text"
            v-model="sectionForm.image_name"
          />
        </div>
        <div class="flex-r">
          <button
            type="submit"
            @click="addPostSection()"
            class="bg-blue-500 text-white px-4 py-2 rounded"
          >
            Add Section
          </button>
          <button
            type="button"
            @click="closeSectionForm"
            class="bg-gray-500 text-white px-4 py-2 rounded ml-2"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Update Section -->
  <div
    class="fixed right-0 top-0 bottom-0 left-0 p-4 z-30"
    style="background-color: rgba(0, 0, 0, 56%)"
    v-if="updatesectionForm"
  >
    <div
      class="bg-white absolute right-1/2 top-1/2 translate-x-1/2 -translate-y-1/2 p-4"
      style="max-height: 600px !important; width: 400px; overflow: scroll; overflow-y: scroll"
    >
      <h2>Add Section</h2>
      <div class="flex-c gap-4">
        <div class="flex-c">
          <div class="font-semibold">Section name</div>
          <input
            type="text"
            v-model="sectionEditForm.section_name"
          />
        </div>
        <div class="flex-c">
          <div class="font-semibold">Content</div>
          <textarea
            type="text"
            v-model="sectionEditForm.content"
          >
          </textarea>
        </div>
        <div class="flex-c">
          <div class="font-semibold">Image Link</div>
          <input
            type="text"
            v-model="sectionEditForm.image_link"
            readonly
          />
          <input
            type="file"
            @change="onFileChange"
          />
          <div class="flex flex-row mt-4">
            <button
              type="submit"
              class="bg-blue-500 text-white px-4 py-2 rounded"
              @click="uploadImage"
            >
              Upload
            </button>
          </div>
        </div>
        <div class="flex-c">
          <div class="font-semibold">Image Name</div>
          <input
            type="text"
            v-model="sectionEditForm.image_name"
          />
        </div>
        <div class="flex-r">
          <button
            type="submit"
            @click="updatePostSection()"
            class="bg-blue-500 text-white px-4 py-2 rounded"
          >
            Update
          </button>
          <button
            type="button"
            @click="closeEditSectionForm"
            class="bg-gray-500 text-white px-4 py-2 rounded ml-2"
          >
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Admin from "@/services/admin.service";
import PostService from "@/services/post.service";
import axios from "axios";

export default {
  name: "BlogPortal",
  data() {
    return {
      datas: [],
      sections: [],
      isSectionView: false,
      isFormOpen: false,
      isFormUpdateOpen: false,
      addsectionForm: false,
      updatesectionForm: false,
      blogForm: {
        title: "",
        description: "",
        thumbnail: "",
        language: "EN",
      },
      blogUpdateForm: {
        title: "",
        description: "",
        thumbnail: "",
        language: "EN",
      },
      sectionForm: {
        section_name: "",
        content: "",
        image_link: "",
        image_name: "",
        language: "EN",
      },
      sectionEditForm: {
        section_name: "",
        content: "",
        image_link: "",
        image_name: "",
        language: "EN",
      },
      post_id: "",
      post_edit_id: "",
      post_section_edit: "",
    };
  },
  mounted() {
    this.getBlog();
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
    async getBlog() {
      const response = await Admin.getBlog();
      console.log(response.data.data.posts);
      this.datas = response.data.data.posts;
      console.log(this.datas, "post");
    },
    async viewSection(id) {
      this.post_id = id;
      this.isSectionView = true;
      const res = await PostService.getSection(id);
      this.sections = res.data.data.post_sections;
      console.log(this.sections);
    },
    closeSection() {
      this.isSectionView = false;
    },
    async deleteBlog(id) {
      try {
        await PostService.deleteData(id);
        this.getBlog();
        alert("Delete Successfully!");
      } catch (error) {
        alert(error);
      }
    },
    //add Blog
    openBlogForm() {
      this.isFormOpen = true;
    },
    closeBlogForm() {
      this.isFormOpen = false;
      this.isFormUpdateOpen = false;
    },
    async addBlog() {
      try {
        await PostService.storeData(this.blogForm).then(() => {
          this.getBlog();
          alert("Add Successfully!");
          this.isFormOpen = false;
        });
      } catch (error) {
        console.log(error);
      }
    },
    //Update Blog
    openUpdateBlogForm(title, description, thumbnail, post_id) {
      (this.blogUpdateForm.title = title),
        (this.blogUpdateForm.description = description),
        (this.blogUpdateForm.thumbnail = thumbnail),
        (this.post_edit_id = post_id),
        (this.isFormUpdateOpen = true);
      console.log(this.blogUpdateForm);
    },
    async updateBlog() {
      try {
        await PostService.updateData(this.post_edit_id, this.blogUpdateForm)
          .then(() => {
            this.getBlog();
            alert("Update Successfully!");
            this.isFormUpdateOpen = false;
          })
          .catch((error) => {
            console.log(error);
          });
      } catch (error) {
        console.log(error);
      }
    },
    //Post section
    openSectionForm() {
      this.addsectionForm = true;
    },
    closeSectionForm() {
      this.addsectionForm = false;
    },
    async addPostSection() {
      try {
        await PostService.addPostSection(this.post_id, this.sectionForm)
          .then(async () => {
            await PostService.getSection(this.post_id).then((res) => {
              this.sections = res.data.data.post_sections;
              alert("Add Successfully!");
              this.addsectionForm = false;
            });
          })
          .catch((err) => {
            console.log(err);
          });
      } catch (error) {
        console.log(error);
      }
    },
    async deletePostSection(id) {
      const post_id = this.post_id;
      try {
        await PostService.deletePostSection(post_id, id);
        this.viewSection(this.post_id);
        alert("Delete Successfully!");
      } catch (error) {
        console.log(error);
      }
    },
    //Open Edit Post Section
    openEditSectionForm(section_name, content, image_link, image_name, id) {
      this.updatesectionForm = true;
      this.sectionEditForm.section_name = section_name;
      (this.sectionEditForm.content = content),
        (this.sectionEditForm.image_link = image_link),
        (this.sectionEditForm.image_name = image_name);
      this.post_section_edit = id;
    },
    closeEditSectionForm() {
      this.updatesectionForm = false;
    },
    async updatePostSection() {
      try {
        await PostService.updatePostSection(
          this.post_id,
          this.post_section_edit,
          this.sectionEditForm
        )
          .then(() => {
            this.viewSection(this.post_id);
            alert("Update Sucessfully");
            this.updatesectionForm = false;
          })
          .catch((err) => console.log(err));
      } catch (error) {
        alert(error);
      }
    },
    onFileChange(event) {
      this.selectedFile = event.target.files[0];
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
        this.blogForm.thumbnail = response.data.secure_url;
        this.blogUpdateForm.thumbnail = response.data.secure_url;
        this.sectionForm.image_link = response.data.secure_url;
        this.sectionEditForm.image_link = response.data.secure_url;
        alert("Upload successful!");
      } catch (error) {
        console.error("Error uploading image:", error);
        alert("Upload failed. Please try again.");
      }
    },
  },
};
</script>

<style scoped>
table th,
td {
  background-color: white;
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

th,
td {
  background-color: white;
}

input,
textarea {
  border: 1px solid black;
  min-height: 24px;
  padding: 4px;
}
</style>
