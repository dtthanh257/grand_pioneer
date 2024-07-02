<template>
  <div class="container mx-auto px-4 py-8 text-xs">
    <div class="container mx-auto px-4 py-8 text-xs">
      <div class="flex-c gap-5 mb-5">
        <div class="flex-r items-center mb-4 justify-between">
          <h1 class="text-2xl font-bold">Voyages List</h1>
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
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Location</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Embark</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Debark</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Fares</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Dates available</th>

              <th class="py-2 px-3 sticky top-0 bg-gray-200">Created At</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Updated At</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="voyage in voyages" :key="voyage.id">
              <td class="border px-4 py-2">{{ voyage.id }}</td>
              <td class="border px-4 py-2">{{ voyage.title }}</td>
              <td class="border px-4 py-2">{{ voyage.content }}</td>
              <td class="border px-4 py-2">
                {{ voyage.summary_location }}
              </td>
              <td class="border px-4 py-2">
                {{ voyage.embark }}
              </td>
              <td class="border px-4 py-2">
                {{ voyage.debark }}
              </td>
              <td class="border px-4 py-2">
                {{ voyage.fares }}
              </td>
              <td class="border px-4 py-2">
                <li class="list-none" v-for="index in voyage.voyage_date_available" :key="index">
                  <div class="">
                    Start Date: {{ index.start_date }} / End Date: {{ index.end_date }}
                  </div>
                </li>
              </td>
              <td class="border px-4 py-2">{{ formatDateTime(voyage.created_at) }}</td>
              <td class="border px-4 py-2">{{ formatDateTime(voyage.updated_at) }}</td>
              <td class="border px-4 py-2 sticky-col bg-white space-x-2">
                <div class="flex flex-r gap-3">
                  <div class="flex-c gap-3">
                    <button @click="
                      openEditVoyageForm(
                        voyage.title,
                        voyage.content,
                        voyage.embark,
                        voyage.debark,
                        voyage.fares,
                        voyage.summary_location,
                        voyage.id,
                        voyage.vessel_id
                      )
                      " class="bg-blue-500 text-white px-2 py-1 rounded">
                      Edit
                    </button>
                    <button @click="deleteVoyage(voyage.id)" class="bg-red-500 text-white px-2 py-1 rounded">
                      Delete
                    </button>
                    <button @click="showDateAvai(voyage.voyage_date_available, voyage.id)"
                      class="bg-blue-500 text-white px-2 py-1 rounded">
                      Add Date Available
                    </button>
                    <button class="bg-blue-500 text-white px-2 py-1 rounded" @click="openFormUploadImage(voyage.id)">
                      Add photo
                    </button>
                  </div>
                  <div class="flex-c gap-3">
                    <button class="bg-blue-500 text-white px-2 py-1 rounded" @click="openExperience(voyage.id)">
                      Add Experience
                    </button>
                    <button class="bg-blue-500 text-white px-2 py-1 rounded" @click="openLocation(voyage.id)">
                      Add Location
                    </button>
                    <button class="bg-blue-500 text-white px-2 py-1 rounded" @click="openTimeline(voyage.id)">
                      Add Timelines
                    </button>
                    <button class="bg-blue-500 text-white px-2 py-1 rounded" @click="openActivity(voyage.id)">
                      Add activities
                    </button>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Add Form -->
    <div class="bg-black bg-opacity-50 fixed top-0 right-0 left-0 bottom-0 z-10" v-if="isFormShown">
      <div
        class="absolute overflow-scroll px-4 pt-4 gap-4 right-1/2 flex-c translate-x-1/2 bg-white top-1/2 -translate-y-1/2 justify-around"
        style="height: 800px; width: 800px">
        <div class="font-semibold">Add Voyages</div>

        <select name="" id="" @change="handleSelectUpdate" class="border border-black" v-model="this.form.vessel_id">
          <option :value="vessel.id" v-for="vessel in vessels" :key="vessel">
            {{ vessel.name }}
          </option>
        </select>
        <div class="flex-c gap-4">
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Title</div>
            <input type="text" v-model="this.form.title" placeholder="title" />
          </div>
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Content</div>
            <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>
          </div>
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Embark</div>
            <input type="text" v-model="this.form.embark" placeholder="embark" />
          </div>
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Debark</div>
            <input type="text" v-model="this.form.debark" placeholder="debark" />
          </div>
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Fares</div>
            <input type="text" v-model="this.form.fares" placeholder="fares" />
          </div>
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Summary Location</div>
            <textarea type="text" v-model="this.form.summary_location" placeholder="location"></textarea>
          </div>
        </div>

        <div class="flex-r gap-3">
          <button @click="addVoyages" class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Voyages
          </button>
          <button @click="closeForm" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
            Cancel
          </button>
        </div>
      </div>
    </div>

    <!-- Voyage update form -->
    <div class="bg-black bg-opacity-50 fixed top-0 right-0 left-0 bottom-0 z-10" v-if="isUpdateForm">
      <div
        class="absolute overflow-scroll px-4 pt-4 gap-4 right-1/2 flex-c translate-x-1/2 bg-white top-1/2 -translate-y-1/2 justify-around"
        style="height: 800px; width: 800px">
        <div class="font-semibold">Update Voyages</div>

        <select name="" id="" @change="handleSelectUpdate" class="border border-black" v-model="this.form.vessel_id">
          <option :value="vessel.id" v-for="vessel in vessels" :key="vessel">
            {{ vessel.name }}
          </option>
        </select>
        <div class="flex-c gap-4">
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Title</div>
            <input type="text" v-model="form_update.title" placeholder="title" />
          </div>
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Content</div>
            <ckeditor :editor="editor" v-model="form_update.content" :config="editorConfig"></ckeditor>
          </div>
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Embark</div>
            <input type="text" v-model="form_update.embark" placeholder="embark" />
          </div>
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Debark</div>
            <input type="text" v-model="form_update.debark" placeholder="debark" />
          </div>
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Fares</div>
            <input type="text" v-model="form_update.fares" placeholder="fares" />
          </div>
          <div class="flex-r gap-3">
            <div class="font-semibold flex-1">Summary Location</div>
            <textarea type="text" v-model="form_update.summary_location" placeholder="location"></textarea>
          </div>
        </div>

        <div class="flex-r gap-3">
          <button @click="updateVoyage" class="bg-blue-500 text-white px-4 py-2 rounded">
            Update Voyages
          </button>
          <button @click="closeEditVoyageForm" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
            Cancel
          </button>
        </div>
      </div>
    </div>

    <div class="fixed top-0 right-0 left-0 bottom-0 z-10" style="background-color: rgba(0, 0, 0, 56%)"
      v-if="isDateAvai">
      <div class="bg-white absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2 p-4"
        style="width: 500px; height: 800px">
        <div class="flex-c gap-3">
          <div class="flex-r justify-between" v-for="index in this.date_available" :key="index">
            <div class="flex-c">
              <div class="flex-c">Start date: {{ index.start_date }}</div>
              <div class="flex-c">End date: {{ index.end_date }}</div>
            </div>
            <button @click="deleteVoyageDate(index.id)" class="bg-red-500 text-white px-2 py-1 rounded">
              Delete
            </button>
          </div>
          <div class="flex-c">
            <div class="font-medim">Start date</div>
            <input type="datetime-local" v-model="date_detail.start_date" />
          </div>
          <div class="flex-c">
            <div class="font-medim">End date</div>
            <input type="datetime-local" v-model="date_detail.end_date" />
          </div>
          <div class="flex flex-row mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" @click="addDateDetail">
              Add date
            </button>
            <button type="button" @click="closeDateAvail" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Upload image -->
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

  <!-- Activity -->
  <div class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
    v-if="isActivityOpen">
    <div class="add-form bg-white rounded p-4 overflow-scroll">
      <div class="flex flex-row items-center justify-between">
        <h2 class="text-xl font-bold pb-2">Add Activity</h2>
        <div class="flex-r font-semibold gap-2 items-center cursor-pointer" @click="openFormAddActivity">
          <div class="addBtn bg-contain"></div>
          Add new
        </div>
      </div>

      <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mb-10">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
          <thead>
            <tr class="text-left">
              <th class="py-2 px-3 sticky top-0 bg-gray-200">ID</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Title</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Content</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in activities" :key="data.id">
              <td class="border px-4 py-2">{{ data.id }}</td>
              <td class="border px-4 py-2">{{ data.title }}</td>
              <td class="border px-4 py-2">{{ data.content }}</td>
              <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
                <div class="flex flex-row gap-3">
                  <button class="bg-red-500 text-white px-4 py-2 rounded" @click="deleteActivity(data.id)">
                    Delete
                  </button>
                  <button class="bg-blue-500 text-white px-4 py-2 rounded"
                    @click="openUpdateActivities(data.id, data.title, data.content)">
                    Edit Activity
                  </button>
                  <button class="bg-blue-500 text-white px-4 py-2 rounded"
                    @click="openFormUploadImageActivity(data.id)">
                    Add Photo
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <button class="bg-gray-500 text-white px-4 py-2 rounded" @click="closeForm">
        Close
      </button>
    </div>
  </div>

  <!-- Add Activity -->
  <div class="bg-black bg-opacity-50 fixed top-0 right-0 left-0 bottom-0 z-10" v-if="isAddActivityOpen">
    <div
      class="absolute overflow-scroll px-4 pt-4 gap-4 right-1/2 flex-c translate-x-1/2 bg-white top-1/2 -translate-y-1/2 justify-around"
      style="height: 800px; width: 800px">
      <div class="font-semibold">Add Activity</div>
      <div class="flex-c gap-4">
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Title</div>
          <input type="text" v-model="this.formActivity.title" placeholder="title" />
        </div>
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Content</div>
          <textarea type="text" v-model="this.formActivity.content" placeholder="content"></textarea>
        </div>
      </div>

      <div class="flex-r gap-3">
        <button @click="addActivities()" class="bg-blue-500 text-white px-4 py-2 rounded">
          Add Activities
        </button>
        <button @click="isAddActivityOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <!-- Update Activity -->
  <div class="bg-black bg-opacity-50 fixed top-0 right-0 left-0 bottom-0 z-10" v-if="isUpdateActivityOpen">
    <div
      class="absolute overflow-scroll px-4 pt-4 gap-4 right-1/2 flex-c translate-x-1/2 bg-white top-1/2 -translate-y-1/2 justify-around"
      style="height: 800px; width: 800px">
      <div class="font-semibold">Activities</div>
      <div class="flex-c gap-4">
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Title</div>
          <input type="text" v-model="this.formUpdateActivity.title" placeholder="title" />
        </div>
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Content</div>
          <textarea type="text" v-model="this.formUpdateActivity.content" placeholder="content"></textarea>
        </div>
      </div>

      <div class="flex-r gap-3">
        <button @click="UpdateActivities()" class="bg-blue-500 text-white px-4 py-2 rounded">
          Update Activities
        </button>
        <button @click="isUpdateActivityOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <!-- Upload Image Activity -->
  <div class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
    v-if="isFormUploadImageActivityOpen">
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
            <tr v-for="data in activity_metadata" :key="data.id">
              <td class="border px-4 py-2">{{ data.id }}</td>
              <td class="border px-4 py-2">{{ data.image_link }}</td>
              <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
                <button @click="deleteActivityMetadata(data.id)" class="bg-red-500 text-white px-2 py-1 rounded">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <input type="file" @change="onFileChange" />
      <div class="flex flex-row mt-4">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" @click="uploadImageActivity">
          Upload
        </button>
        <button type="button" @click="isFormUploadImageActivityOpen = false"
          class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <!-- Location -->
  <div class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
    v-if="isLocationOpen">
    <div class="add-form bg-white rounded p-4 overflow-scroll">
      <div class="flex flex-row items-center justify-between">
        <h2 class="text-xl font-bold pb-2">Add Location</h2>
        <div class="flex-r font-semibold gap-2 items-center cursor-pointer" @click="openFormAddLocation()">
          <div class="addBtn bg-contain"></div>
          Add new
        </div>
      </div>

      <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mb-10">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
          <thead>
            <tr class="text-left">
              <th class="py-2 px-3 sticky top-0 bg-gray-200">ID</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Title</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Sub Title</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Description</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in locations" :key="data.id">
              <td class="border px-4 py-2">{{ data.id }}</td>
              <td class="border px-4 py-2">{{ data.title }}</td>
              <td class="border px-4 py-2">{{ data.sub_title }}</td>
              <td class="border px-4 py-2">{{ data.description }}</td>
              <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
                <div class="flex flex-row gap-3">
                  <button class="bg-red-500 text-white px-4 py-2 rounded" @click="deleteLocation(data.id)">
                    Delete
                  </button>
                  <button class="bg-blue-500 text-white px-4 py-2 rounded" @click="
                    openUpdateLocation(data.id, data.title, data.description, data.sub_title)
                    ">
                    Edit Location
                  </button>
                  <button class="bg-blue-500 text-white px-4 py-2 rounded"
                    @click="openFormUploadImageLocation(data.id)">
                    Add Photo
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <button class="bg-gray-500 text-white px-4 py-2 rounded" @click="closeForm">
        Close
      </button>
    </div>
  </div>

  <!-- Add Location -->
  <div class="bg-black bg-opacity-50 fixed top-0 right-0 left-0 bottom-0 z-10" v-if="isAddLocationOpen">
    <div
      class="absolute overflow-scroll px-4 pt-4 gap-4 right-1/2 flex-c translate-x-1/2 bg-white top-1/2 -translate-y-1/2 justify-around"
      style="height: 800px; width: 800px">
      <div class="font-semibold">Add Location</div>
      <div class="flex-c gap-4">
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Title</div>
          <input type="text" v-model="this.formLocation.title" placeholder="title" />
        </div>
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Sub Title</div>
          <textarea type="text" v-model="this.formLocation.sub_title" placeholder="sub title"></textarea>
        </div>
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Description</div>
          <textarea type="text" v-model="this.formLocation.description" placeholder="description"></textarea>
        </div>
      </div>

      <div class="flex-r gap-3">
        <button @click="addLocation()" class="bg-blue-500 text-white px-4 py-2 rounded">
          Add Location
        </button>
        <button @click="isAddLocationOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <!-- Update Location -->
  <div class="bg-black bg-opacity-50 fixed top-0 right-0 left-0 bottom-0 z-10" v-if="isUpdateLocationOpen">
    <div
      class="absolute overflow-scroll px-4 pt-4 gap-4 right-1/2 flex-c translate-x-1/2 bg-white top-1/2 -translate-y-1/2 justify-around"
      style="height: 800px; width: 800px">
      <div class="font-semibold">Location</div>
      <div class="flex-c gap-4">
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Title</div>
          <input type="text" v-model="this.formUpdateLocation.title" placeholder="title" />
        </div>
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Sub Title</div>
          <textarea type="text" v-model="this.formUpdateLocation.sub_title" placeholder="sub title"></textarea>
        </div>
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Description</div>
          <textarea type="text" v-model="this.formUpdateLocation.description" placeholder="description"></textarea>
        </div>
      </div>

      <div class="flex-r gap-3">
        <button @click="UpdateLocation()" class="bg-blue-500 text-white px-4 py-2 rounded">
          Update Location
        </button>
        <button @click="isUpdateLocationOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <!-- Upload Image Location -->
  <div class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
    v-if="isFormUploadImageLocationOpen">
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
            <tr v-for="data in location_metadata" :key="data.id">
              <td class="border px-4 py-2">{{ data.id }}</td>
              <td class="border px-4 py-2">{{ data.image_link }}</td>
              <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
                <button @click="deleteLocationMetadata(data.id)" class="bg-red-500 text-white px-2 py-1 rounded">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <input type="file" @change="onFileChange" />
      <div class="flex flex-row mt-4">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" @click="uploadImageLocation">
          Upload
        </button>
        <button type="button" @click="isFormUploadImageLocationOpen = false"
          class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <!-- Experience -->
  <div class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
    v-if="isExperienceOpen">
    <div class="add-form bg-white rounded p-4 overflow-scroll">
      <div class="flex flex-row items-center justify-between">
        <h2 class="text-xl font-bold pb-2">Add Experience</h2>
        <div class="flex-r font-semibold gap-2 items-center cursor-pointer" @click="openFormAddExperience">
          <div class="addBtn bg-contain"></div>
          Add new
        </div>
      </div>

      <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mb-10">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
          <thead>
            <tr class="text-left">
              <th class="py-2 px-3 sticky top-0 bg-gray-200">ID</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Experience</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in experiences" :key="data.id">
              <td class="border px-4 py-2">{{ data.id }}</td>
              <td class="border px-4 py-2">{{ data.review }}</td>
              <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
                <div class="flex flex-row gap-3">
                  <button class="bg-red-500 text-white px-4 py-2 rounded" @click="deleteExperience(data.id)">
                    Delete
                  </button>
                  <button class="bg-blue-500 text-white px-4 py-2 rounded"
                    @click="openUpdateExperience(data.id, data.review)">
                    Edit Experience
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <button class="bg-gray-500 text-white px-4 py-2 rounded" @click="closeForm">
        Close
      </button>
    </div>
  </div>

  <!-- Add Experience -->
  <div class="bg-black bg-opacity-50 fixed top-0 right-0 left-0 bottom-0 z-10" v-if="isAddExperienceOpen">
    <div
      class="absolute overflow-scroll px-4 pt-4 gap-4 right-1/2 flex-c translate-x-1/2 bg-white top-1/2 -translate-y-1/2 justify-around"
      style="height: 800px; width: 800px">
      <div class="font-semibold">Add Experience</div>
      <div class="flex-c gap-4">
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Experience</div>
          <textarea type="text" v-model="this.formExperience.review" placeholder="experience"></textarea>
        </div>
      </div>

      <div class="flex-r gap-3">
        <button @click="addExperience()" class="bg-blue-500 text-white px-4 py-2 rounded">
          Add Experience
        </button>
        <button @click="isAddExperienceOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <!-- Update Experience -->
  <div class="bg-black bg-opacity-50 fixed top-0 right-0 left-0 bottom-0 z-10" v-if="isUpdateExperienceOpen">
    <div
      class="absolute overflow-scroll px-4 pt-4 gap-4 right-1/2 flex-c translate-x-1/2 bg-white top-1/2 -translate-y-1/2 justify-around"
      style="height: 800px; width: 800px">
      <div class="font-semibold">Experience</div>
      <div class="flex-c gap-4">
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Experience</div>
          <textarea type="text" v-model="this.formUpdateExperience.review" placeholder="experience"></textarea>
        </div>
      </div>

      <div class="flex-r gap-3">
        <button @click="UpdateExperience()" class="bg-blue-500 text-white px-4 py-2 rounded">
          Update Experience
        </button>
        <button @click="isUpdateExperienceOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <!-- Timeline -->
  <div class="fixed top-0 bottom-0 right-0 left-0 bg-black bg-opacity-50 z-10 flex items-center justify-center"
    v-if="isTimelineOpen">
    <div class="add-form bg-white rounded p-4 overflow-scroll">
      <div class="flex flex-row items-center justify-between">
        <h2 class="text-xl font-bold pb-2">Add Timeline</h2>
        <div class="flex-r font-semibold gap-2 items-center cursor-pointer" @click="openFormAddTimeline">
          <div class="addBtn bg-contain"></div>
          Add new
        </div>
      </div>

      <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mb-10">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
          <thead>
            <tr class="text-left">
              <th class="py-2 px-3 sticky top-0 bg-gray-200">ID</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Day Time</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Time</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200">Detail</th>
              <th class="py-2 px-3 sticky top-0 bg-gray-200 sticky-col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in timelines" :key="data.id">
              <td class="border px-4 py-2">{{ data.id }}</td>
              <td class="border px-4 py-2">{{ data.daytime }}</td>
              <td class="border px-4 py-2">{{ data.time }}</td>
              <td class="border px-4 py-2">{{ data.detail }}</td>
              <td class="border px-4 py-2 sticky-col bg-white flex justify-center space-x-2">
                <div class="flex flex-row gap-3">
                  <button class="bg-red-500 text-white px-4 py-2 rounded" @click="deleteTimeline(data.id)">
                    Delete
                  </button>
                  <button class="bg-blue-500 text-white px-4 py-2 rounded"
                    @click="openUpdateTimeline(data.id, data.daytime, data.time, data.detail)">
                    Edit Timeline
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <button class="bg-gray-500 text-white px-4 py-2 rounded" @click="closeForm">
        Close
      </button>
    </div>
  </div>

  <!-- Add Timeline -->
  <div class="bg-black bg-opacity-50 fixed top-0 right-0 left-0 bottom-0 z-10" v-if="isAddTimelineOpen">
    <div
      class="absolute overflow-scroll px-4 pt-4 gap-4 right-1/2 flex-c translate-x-1/2 bg-white top-1/2 -translate-y-1/2 justify-around"
      style="height: 800px; width: 800px">
      <div class="font-semibold">Add Timeline</div>
      <div class="flex-c gap-4">
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Daytime</div>
          <input type="text" v-model="this.formTimeline.daytime" placeholder="daytime" />
        </div>
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Time</div>
          <textarea type="text" v-model="this.formTimeline.time" placeholder="time"></textarea>
        </div>
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Detail</div>
          <textarea type="text" v-model="this.formTimeline.detail" placeholder="detail"></textarea>
        </div>
      </div>

      <div class="flex-r gap-3">
        <button @click="addTimeline()" class="bg-blue-500 text-white px-4 py-2 rounded">
          Add Timeline
        </button>
        <button @click="isAddTimelineOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>

  <!-- Update Timeline -->
  <div class="bg-black bg-opacity-50 fixed top-0 right-0 left-0 bottom-0 z-10" v-if="isUpdateTimelineOpen">
    <div
      class="absolute overflow-scroll px-4 pt-4 gap-4 right-1/2 flex-c translate-x-1/2 bg-white top-1/2 -translate-y-1/2 justify-around"
      style="height: 800px; width: 800px">
      <div class="font-semibold">Timeline</div>
      <div class="flex-c gap-4">
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Daytime</div>
          <input type="text" v-model="this.formUpdateTimeline.daytime" placeholder="daytime" />
        </div>
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Time</div>
          <textarea type="text" v-model="this.formUpdateTimeline.time" placeholder="time"></textarea>
        </div>
        <div class="flex-r gap-3">
          <div class="font-semibold flex-1">Detail</div>
          <textarea type="text" v-model="this.formUpdateTimeline.detail" placeholder="detail"></textarea>
        </div>
      </div>

      <div class="flex-r gap-3">
        <button @click="UpdateTimeline()" class="bg-blue-500 text-white px-4 py-2 rounded">
          Update Timeline
        </button>
        <button @click="isUpdateTimelineOpen = false" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import Admin from "@/services/admin.service";
import VoyageService from "@/services/voyage.service";
import axios from "axios";
import VoyageMetadataService from "@/services/voyage.metadata.service";
import ActivityService from "@/services/activity.service";
import ActivityMetadataService from "@/services/activity.metadata.service";
import LocationService from "@/services/location.service";
import LocationMetadataService from "@/services/location.metadata.service";
import ExperienceService from "@/services/experience.service";
import TimelineService from "@/services/timeline.service";
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
  name: "VoyagesPortal",
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
      vessels: [],
      voyages: [],
      metadata: [],
      activities: [],
      activity_metadata: [],
      activity_id: "",
      voyage_id: "",
      vessel_id: "",
      form: {
        vessel_id: "",
        title: "",
        content: "",
        embark: "",
        debark: "",
        fares: "",
        summary_location: "",
        language: "EN",
      },
      form_update: {
        vessel_id: "",
        title: "",
        content: "",
        embark: "",
        debark: "",
        fares: "",
        summary_location: "",
        language: "EN",
      },
      isFormShown: false,
      isUpdateForm: false,
      isFormUploadImageOpen: false,
      voyage_update_id: "",
      isDateAvai: false,
      date_available: [],
      date_detail: {
        start_date: "",
        end_date: "",
      },
      isActivityOpen: false,
      isAddActivityOpen: false,
      formActivity: {
        title: "",
        content: "",
        language: "EN",
      },
      isUpdateActivityOpen: false,
      formUpdateActivity: {
        title: "",
        content: "",
        language: "EN",
      },
      isFormUploadImageActivityOpen: false,
      //location
      locations: [],
      location_metadata: [],
      isLocationOpen: false,
      isAddLocationOpen: false,
      formLocation: {
        title: "",
        sub_title: "",
        description: "",
        language: "EN",
      },
      isUpdateLocationOpen: false,
      formUpdateLocation: {
        title: "",
        sub_title: "",
        description: "",
        language: "EN",
      },
      isFormUploadImageLocationOpen: false,
      location_id: "",

      //experience
      experiences: [],
      experience_metadata: [],
      isExperienceOpen: false,
      isAddExperienceOpen: false,
      formExperience: {
        review: "",
        language: "EN",
      },
      isUpdateExperienceOpen: false,
      formUpdateExperience: {
        review: "",
        language: "EN",
      },
      isFormUploadImageExperienceOpen: false,
      experience_id: "",

      //timeline
      timelines: [],
      timeline_metadata: [],
      isTimelineOpen: false,
      isAddTimelineOpen: false,
      formTimeline: {
        daytime: "",
        time: "",
        detail: "",
        language: "EN",
      },
      isUpdateTimelineOpen: false,
      formUpdateTimeline: {
        daytime: "",
        time: "",
        detail: "",
        language: "EN",
      },
      isFormUploadImageTimelineOpen: false,
      timeline_id: "",
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
      this.vessels = response.data.data.vessels;
      console.log(this.vessels);
    },
    async getVoyageByVessel(id) {
      try {
        const res = await Admin.getVoyageByVessel(id);
        console.log(res.data.data.voyages);
        this.voyages = res.data.data.voyages;
      } catch (error) {
        alert(error);
      }
    },
    async deleteVoyage(id) {
      try {
        await VoyageService.deleteData(id, this.vessel_id)
          .then(async () => {
            await VoyageService.getData(this.vessel_id)
              .then((res) => {
                this.voyages = res.data.data.voyages;
                alert("Delete Successfully!");
              })
              .catch((err) => console.log(err));
          })
          .catch((err) => console.log(err));
      } catch (error) {
        alert(error);
      }
    },
    handleSelect(event) {
      const vesselId = event.target.value;
      if (vesselId) {
        this.getVoyageByVessel(vesselId);
      }
      this.vessel_id = vesselId;
    },
    //Add voyages
    async addVoyages() {
      await VoyageService.storeData(this.form, this.form.vessel_id)
        .then(async () => {
          await VoyageService.getDataByVoyage(this.vessel_id)
            .then((res) => {
              this.voyages = res.data.data.voyages;
              this.isFormShown = false;
              alert("Add Voyage Successfully!");
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },
    openForm() {
      this.isFormShown = true;
    },
    closeForm() {
      this.isFormShown = false;
      this.isAddActivityOpen = false;
      this.isActivityOpen = false;
      this.isLocationOpen = false;
      this.isExperienceOpen = false;
      this.isTimelineOpen = false;
    },
    //Edit Voyage
    openEditVoyageForm(title, content, embark, debark, fares, summary_location, id, vessel_id) {
      this.isUpdateForm = true;
      this.form_update.title = title;
      this.form_update.content = content;
      this.form_update.embark = embark;
      this.form_update.debark = debark;
      this.form_update.fares = fares;
      this.form_update.summary_location = summary_location;
      this.voyage_update_id = id;
      this.vessel_id = vessel_id;
    },
    closeEditVoyageForm() {
      this.isUpdateForm = false;
    },
    async updateVoyage() {
      try {
        await Admin.updateVoyage(this.vessel_id, this.voyage_update_id, this.form_update).then(
          async () => {
            await Admin.getVoyageByVessel(this.vessel_id).then((res) => {
              this.voyages = res.data.data.voyages;
              alert("Update Successfully!");
              this.isUpdateForm = false;
            });
          }
        );
      } catch (error) {
        alert(error);
      }
    },
    handleSelectUpdate(event) {
      const vesselId = event.target.value;
      if (vesselId) {
        this.form_update.vessel_id = vesselId;
      }
      localStorage.setItem("vessel_id", vesselId);
    },
    //Date Available
    showDateAvai(date_avail, voyage_id) {
      this.voyage_update_id = voyage_id;
      this.date_available = date_avail;
      this.isDateAvai = true;
      console.log(this.voyage_update_id);
    },
    closeDateAvail() {
      this.isDateAvai = false;
    },
    async deleteVoyageDate(id) {
      try {
        await Admin.deleteDateAvail(this.voyage_update_id, id);
        this.getVoyageByVessel(this.vessel_id);
        alert("Delete Successfully");
      } catch (error) {
        alert(error);
      }
    },
    async addDateDetail() {
      try {
        await Admin.addDateAvail(this.voyage_update_id, this.date_detail);
        this.getVoyageByVessel(this.vessel_id);
        alert("Add date successfully");
      } catch (error) {
        alert(error);
      }
    },

    onFileChange(event) {
      this.selectedFile = event.target.files[0];
    },

    closeFormUploadImage() {
      this.isFormUploadImageOpen = false;
    },
    async openFormUploadImage(id) {
      this.voyage_id = id;
      this.isFormUploadImageOpen = true;
      await VoyageMetadataService.getData(id)
        .then((res) => {
          this.metadata = res.data.data.voyage_metadatas;
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

        await VoyageMetadataService.storeData(this.voyage_id, response.data.secure_url).then(
          async () => {
            alert("Add Image Successfully!");
            await VoyageMetadataService.getData(this.voyage_id)
              .then((res) => {
                this.metadata = res.data.data.voyage_metadatas;
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
      await VoyageMetadataService.deleteData(id, this.voyage_id)
        .then(async () => {
          alert("Delete successfully!");
          const res = await VoyageMetadataService.getData(this.voyage_id);
          this.metadata = res.data.data.voyage_metadatas;
        })
        .catch((err) => console.log(err));
    },

    //Activity
    async openActivity(id) {
      this.voyage_id = id;
      await ActivityService.getDataByVoyage(id)
        .then((res) => {
          this.activities = res.data.data.activities;
          this.isActivityOpen = true;
        })
        .catch((err) => console.log(err));
    },

    openFormAddActivity() {
      this.isAddActivityOpen = true;
    },

    async addActivities() {
      await ActivityService.storeData(this.formActivity, this.voyage_id)
        .then(async () => {
          await ActivityService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.activities = res.data.data.activities;
              this.isAddActivityOpen = false;
              alert("Add Successfully!");
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    async deleteActivity(id) {
      await ActivityService.deleteData(id, this.voyage_id)
        .then(async () => {
          await ActivityService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.activities = res.data.data.activities;
              alert("Delete Successfully!");
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    openUpdateActivities(id, title, content) {
      this.activity_id = id;
      this.formUpdateActivity.title = title;
      this.formUpdateActivity.content = content;
      this.isUpdateActivityOpen = true;
    },

    async UpdateActivities() {
      await ActivityService.updateData(this.activity_id, this.voyage_id, this.formUpdateActivity)
        .then(async () => {
          await ActivityService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.activities = res.data.data.activities;
              alert("Update Successfully!");
              this.isUpdateActivityOpen = false;
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    async openFormUploadImageActivity(id) {
      this.activity_id = id;
      await ActivityMetadataService.getData(id)
        .then((res) => {
          this.activity_metadata = res.data.data.activity_metadatas;
        })
        .catch((err) => console.log(err));
      this.isFormUploadImageActivityOpen = true;
    },

    async uploadImageActivity() {
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
        await ActivityMetadataService.storeData(this.activity_id, response.data.secure_url)
          .then(async () => {
            await ActivityMetadataService.getData(this.activity_id)
              .then((res) => {
                this.activity_metadata = res.data.data.activity_metadatas;
                alert("Add Image Successfully!");
              })
              .catch((err) => {
                console.log(err);
              });
          })
          .catch((err) => console.log(err));

        alert("Upload successful!");
      } catch (error) {
        console.error("Error uploading image:", error);
        alert("Upload failed. Please try again.");
      }
    },

    async deleteActivityMetadata(id) {
      await ActivityMetadataService.deleteData(id, this.activity_id)
        .then(async () => {
          alert("Delete successfully!");
          await ActivityMetadataService.getData(this.activity_id).then((res) => {
            this.activity_metadata = res.data.data.activity_metadatas;
          });
        })
        .catch((err) => console.log(err));
    },

    //Location
    async openLocation(id) {
      this.voyage_id = id;
      await LocationService.getDataByVoyage(id)
        .then((res) => {
          this.locations = res.data.data.voyage_locations;
          this.isLocationOpen = true;
        })
        .catch((err) => console.log(err));
    },

    openFormAddLocation() {
      this.isAddLocationOpen = true;
    },

    async addLocation() {
      await LocationService.storeData(this.formLocation, this.voyage_id)
        .then(async () => {
          await LocationService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.locations = res.data.data.voyage_locations;
              this.isAddLocationOpen = false;
              alert("Add Successfully!");
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    async deleteLocation(id) {
      await LocationService.deleteData(id, this.voyage_id)
        .then(async () => {
          await LocationService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.locations = res.data.data.voyage_locations;
              alert("Delete Successfully!");
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    openUpdateLocation(id, title, description, sub_title) {
      this.location_id = id;
      this.formUpdateLocation.title = title;
      this.formUpdateLocation.description = description;
      this.formUpdateLocation.sub_title = sub_title;
      this.isUpdateLocationOpen = true;
    },

    async UpdateLocation() {
      await LocationService.updateData(this.location_id, this.voyage_id, this.formUpdateLocation)
        .then(async () => {
          await LocationService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.locations = res.data.data.voyage_locations;
              alert("Update Successfully!");
              this.isUpdateLocationOpen = false;
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    async openFormUploadImageLocation(id) {
      this.location_id = id;
      await LocationMetadataService.getData(id)
        .then((res) => {
          this.location_metadata = res.data.data.voyage_location_metadatas;
        })
        .catch((err) => console.log(err));
      this.isFormUploadImageLocationOpen = true;
    },

    async uploadImageLocation() {
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
        await LocationMetadataService.storeData(this.location_id, response.data.secure_url)
          .then(async () => {
            await LocationMetadataService.getData(this.location_id)
              .then((res) => {
                this.location_metadata = res.data.data.voyage_location_metadatas;
                alert("Add Image Successfully!");
              })
              .catch((err) => {
                console.log(err);
              });
          })
          .catch((err) => console.log(err));

        alert("Upload successful!");
      } catch (error) {
        console.error("Error uploading image:", error);
        alert("Upload failed. Please try again.");
      }
    },

    async deleteLocationMetadata(id) {
      await LocationMetadataService.deleteData(id, this.location_id)
        .then(async () => {
          alert("Delete successfully!");
          await LocationMetadataService.getData(this.location_id).then((res) => {
            this.location_metadata = res.data.data.voyage_location_metadatas;
          });
        })
        .catch((err) => console.log(err));
    },

    // Experience
    async openExperience(id) {
      this.voyage_id = id;
      await ExperienceService.getDataByVoyage(id)
        .then((res) => {
          this.experiences = res.data.data.voyage_experiences;
          this.isExperienceOpen = true;
        })
        .catch((err) => console.log(err));
    },

    openFormAddExperience() {
      this.isAddExperienceOpen = true;
    },

    async addExperience() {
      await ExperienceService.storeData(this.formExperience, this.voyage_id)
        .then(async () => {
          await ExperienceService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.experiences = res.data.data.voyage_experiences;
              this.isAddExperienceOpen = false;
              alert("Add Successfully!");
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    async deleteExperience(id) {
      await ExperienceService.deleteData(id, this.voyage_id)
        .then(async () => {
          await ExperienceService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.experiences = res.data.data.voyage_experiences;
              alert("Delete Successfully!");
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    openUpdateExperience(id, review) {
      this.experience_id = id;
      this.formUpdateExperience.review = review;
      this.isUpdateExperienceOpen = true;
    },

    async UpdateExperience() {
      await ExperienceService.updateData(
        this.experience_id,
        this.voyage_id,
        this.formUpdateExperience
      )
        .then(async () => {
          await ExperienceService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.experiences = res.data.data.voyage_experiences;
              alert("Update Successfully!");
              this.isUpdateExperienceOpen = false;
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    // Timeline
    async openTimeline(id) {
      this.voyage_id = id;
      await TimelineService.getDataByVoyage(id)
        .then((res) => {
          this.timelines = res.data.data.voyage_timelines;
          this.isTimelineOpen = true;
        })
        .catch((err) => console.log(err));
    },

    openFormAddTimeline() {
      this.isAddTimelineOpen = true;
    },

    async addTimeline() {
      await TimelineService.storeData(this.formTimeline, this.voyage_id)
        .then(async () => {
          await TimelineService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.timelines = res.data.data.voyage_timelines;
              this.isAddTimelineOpen = false;
              alert("Add Successfully!");
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    async deleteTimeline(id) {
      await TimelineService.deleteData(id, this.voyage_id)
        .then(async () => {
          await TimelineService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.timelines = res.data.data.voyage_timelines;
              alert("Delete Successfully!");
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },

    openUpdateTimeline(id, daytime, time, detail) {
      this.timeline_id = id;
      this.formUpdateTimeline.daytime = daytime;
      this.formUpdateTimeline.time = time;
      this.formUpdateTimeline.detail = detail;
      this.isUpdateTimelineOpen = true;
    },

    async UpdateTimeline() {
      await TimelineService.updateData(this.timeline_id, this.voyage_id, this.formUpdateTimeline)
        .then(async () => {
          await TimelineService.getDataByVoyage(this.voyage_id)
            .then((res) => {
              this.timelines = res.data.data.voyage_timelines;
              alert("Update Successfully!");
              this.isUpdateTimelineOpen = false;
            })
            .catch((err) => console.log(err));
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>
<style scoped>
input,
textarea {
  border: 1px solid black;
  flex: 2;
  outline: none;
  min-height: 24px;
  padding: 4px 4px;
}

select {
  height: 24px;
}
</style>
