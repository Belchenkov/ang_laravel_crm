import { Injectable } from '@angular/core';
import { Observable, throwError } from "rxjs";
import { catchError, map } from "rxjs/operators";
import { HttpClient } from "@angular/common/http";

import { ResponseHttp } from "../models/response-http";
import { environment } from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class LeadsService {
  private apiUrl = environment.apiUrl;

  constructor(
    private http: HttpClient,
  ) { }

  public addSaleCount(): Observable<number> {
    return this.http.get<ResponseHttp>(`${this.apiUrl}/api/admin/leads/add-sale/count`)
      .pipe(
        map((data: ResponseHttp) => data.data.number),
        catchError((error) => throwError(error))
      );
  }
}
