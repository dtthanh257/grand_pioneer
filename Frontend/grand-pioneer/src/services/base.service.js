export const authHeader = () => {
  return {
    "Content-Type": "application/json",
    Authorization: "Bearer " + localStorage.jwt_token,
  };
};
