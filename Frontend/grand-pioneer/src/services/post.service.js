import axios from "axios";
import { authHeader } from "@/services/base.service";
import { BASE_API_URL } from "@/helpers/base.api.url";

class PostService {
  async getData() {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/posts",
    });
  }

  async getDataById(post_id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/posts/" + post_id,
    });
  }

  async storeData(data) {
    return await axios({
      method: "post",
      url: BASE_API_URL + "/posts/",
      headers: authHeader(),
      data: data,
    });
  }

  async updateData(post_id, data) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/posts/" + post_id,
      headers: authHeader(),
      data: data,
    });
  }

  async deleteData(post_id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/posts/" + post_id,
      headers: authHeader(),
    });
  }
  async getSection(id) {
    return await axios({
      method: "get",
      url: BASE_API_URL + "/posts/" + id + "/post-section",
      headers: authHeader(),
    });
  }
  async addPostSection(id, data) {
    return await axios({
      method: "post",
      url: BASE_API_URL + "/posts/" + id + "/post-section",
      headers: authHeader(),
      data: data,
    });
  }
  async deletePostSection(post_id, id) {
    return await axios({
      method: "delete",
      url: BASE_API_URL + "/posts/" + post_id + "/post-section/" + id,
      headers: authHeader(),
    });
  }
  async updatePostSection(post_id, id, data) {
    return await axios({
      method: "put",
      url: BASE_API_URL + "/posts/" + post_id + "/post-section/" + id,
      headers: authHeader(),
      data: data,
    });
  }
}

export default new PostService();
