import { Injectable } from '@angular/core';
import { Observable, throwError } from "rxjs";
import { catchError, map } from "rxjs/operators";
import { HttpClient } from "@angular/common/http";

import { ResponseHttp } from "../models/response-http";
import { environment } from "../../environments/environment";
import { Status } from "../models/status";

@Injectable({
  providedIn: 'root'
})
export class StatusService {
  private apiUrl = environment.apiUrl;

  constructor(
    private http: HttpClient,
  ) { }

  public getStatuses(): Observable<Status[]> {
    return this.http.get<ResponseHttp>(`${this.apiUrl}/api/admin/statuses`)
      .pipe(
        map((data) => data.data.items),
        catchError((error) => throwError(error))
      );
  }
}
