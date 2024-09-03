export interface CreateLoginRequest {
  email: string;
  password: string;
}

export interface GetAuthResponse {
  access_token: string;
  expires: string;
}
