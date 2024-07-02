import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class ActivityMetadataService {
  async getData(activity_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/activities/" + activity_id + "/activity-metadata",
    });
  }

  async getDataById(activity_id, activity_metadata_id) {
    return await axios({
      method: "get",
      url:
        BASE_API_URL + "/activities/" + activity_id + "/activity-metadata/" + activity_metadata_id,
    });
  }

  async storeData(activity_id, image_link) {
    return await axios.post(
      BASE_API_URL + "/activities/" + activity_id + "/activity-metadata",
      { image_link: image_link },
      {
        headers: authHeader(),
      }
    );
  }

  async updateData(activity_metadata_id, activity_id, activity) {
    return await axios({
      method: "put",
      url:
        BASE_API_URL + "/activities/" + activity_id + "/activity-metadata/" + activity_metadata_id,
      activity,
      headers: authHeader(),
    });
  }

  async deleteData(activity_metadata_id, activity_id) {
    return await axios({
      method: "delete",
      url:
        BASE_API_URL + "/activities/" + activity_id + "/activity-metadata/" + activity_metadata_id,
      headers: authHeader(),
    });
  }
}

export default new ActivityMetadataService();
