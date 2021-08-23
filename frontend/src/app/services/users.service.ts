import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { catchError, map } from "rxjs/operators";
import { Observable, throwError } from "rxjs";

import { ResponseHttp } from "../models/response-http";
import { environment } from "../../environments/environment";
import { User } from "../models/user";

@Injectable({
  providedIn: 'root'
})
export class UsersService {
  private apiUrl = environment.apiUrl;

  constructor(
    private http: HttpClient,
  ) { }

  getUsers(): Observable<User[]> {
    return this.http.get<ResponseHttp>(`${this.apiUrl}/api/admin/users`)
      .pipe(
        map((data) => data.data.items),
        catchError((error) => throwError(error))
      );
  }
}
