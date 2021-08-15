import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { catchError, map } from "rxjs/operators";
import { Observable, throwError } from "rxjs";

import { User } from "../../models/user";
import { environment } from "../../../environments/environment";
import { ResponseHttpLogin } from "../../models/response-http-login";
import { ResponseHttpLoginDefault } from "../../models/response-http-login-default";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrl: string = environment.apiUrl;
  private clientId: string = environment.auth.clientId;
  private clientSecret: string = environment.auth.clientSecret;

  constructor(
    private http: HttpClient
  ) { }

  /**
   * Login Laravel Passport
   * @param email
   * @param password
   */
  loginDefault(email: string, password: string): Observable<string> {
    return this.http.post<ResponseHttpLoginDefault>(`${this.apiUrl}/api/oauth/token`, {
      username: email,
      password,
      client_id: this.clientId,
      client_secret: this.clientSecret,
      grant_type: 'password',
      scope: ''
    })
    .pipe(
      // @ts-ignore
      map((data: ResponseHttpLoginDefault) => {
        if (data.access_token) {
          AuthService.setUser(null);
          AuthService.setToken(data.access_token);
          AuthService.setRefreshToken(data.refresh_token);
          return data.access_token;
        }
      }),
      catchError((error) => {
        console.error(error);
        return throwError(error);
      })
    )
  }

  /**
   * Login api
   * @param email
   * @param password
   */
  public login(email: string, password: string) : Observable<User> {
    return this.http.post<ResponseHttpLogin>(`${this.apiUrl}/api/pub/auth/login`, {
      email,
      password
    }).pipe(
      map((data: ResponseHttpLogin) => {
        const user = data.data?.user;
        const token = data.data?.api_token;

        if (user && token) {
          AuthService.setUser(JSON.stringify(user));
          AuthService.setToken(token);
          return user;
        }
        return null;
      }),
      catchError((error) => {
        console.error(error);
        return throwError(error);
      })
    );
  }

  public checkUser(): boolean {
    return !!(sessionStorage.getItem('token') && sessionStorage.getItem('user'));
  }

  public getToken(): string {
    return sessionStorage.getItem('token') ?? '';
  }

  public logout(): void {
    sessionStorage.removeItem('user');
    sessionStorage.removeItem('token');
  }

  private static setUser(user: string): void {
    sessionStorage.setItem('user', user);
  }

  private static setToken(token: string): void {
    sessionStorage.setItem('token', token);
  }

  private static setRefreshToken(refreshToken: string) {
    sessionStorage.setItem('refresh_token', refreshToken);
  }
}
