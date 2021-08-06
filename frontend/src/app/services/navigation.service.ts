import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Observable, throwError } from "rxjs";
import { catchError, map } from "rxjs/operators";

import { Navigation } from "../models/navigation";
import { ResponseHttp } from "../models/response-http";
import { environment } from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class NavigationService {
  private host: string = environment.apiUrl;

  constructor(
    private http: HttpClient
  ) { }

  getNavigation(): Observable<Navigation[]> {
    return this.http.get<ResponseHttp>(`${this.host}/api/admin/menus`)
      .pipe(
        map(({ data }) => {
          return data.items;
        }),
        catchError((error) => {
          console.log("Error - ", error);
          return throwError;
        })
      );
  }
}
