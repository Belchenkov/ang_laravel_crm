import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { catchError, map } from "rxjs/operators";
import { Observable, throwError } from "rxjs";

import { environment } from "../../../environments/environment";
import { ResponseHttpLogin } from "../../models/response-http-login";
import { User } from "../../models/user";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrl: string = environment.apiUrl;

  constructor(
    private http: HttpClient
  ) { }

  /**
   * Login
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
}
