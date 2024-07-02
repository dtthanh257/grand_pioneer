import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class LocationMetadataService {
  async getData(location_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/voyage-locations/" + location_id + "/voyage-location-metadata",
    });
  }

  async getDataById(location_id, location_metadata_id) {
    return await axios({
      method: "get",
      url:
        BASE_API_URL +
        "/voyage-locations/" +
        location_id +
        "/voyage-location-metadata/" +
        location_metadata_id,
    });
  }

  async storeData(location_id, image_link) {
    return await axios.post(
      BASE_API_URL + "/voyage-locations/" + location_id + "/voyage-location-metadata",
      { image_link: image_link },
      {
        headers: authHeader(),
      }
    );
  }

  async updateData(location_metadata_id, location_id, location) {
    return await axios({
      method: "put",
      url:
        BASE_API_URL +
        "/voyage-locations/" +
        location_id +
        "/voyage-location-metadata/" +
        location_metadata_id,
      location,
      headers: authHeader(),
    });
  }

  async deleteData(location_metadata_id, location_id) {
    return await axios({
      method: "delete",
      url:
        BASE_API_URL +
        "/voyage-locations/" +
        location_id +
        "/voyage-location-metadata/" +
        location_metadata_id,
      headers: authHeader(),
    });
  }
}

export default new LocationMetadataService();
