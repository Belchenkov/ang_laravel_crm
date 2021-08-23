import { Injectable } from '@angular/core';
import { Observable, throwError } from "rxjs";
import { catchError, map } from "rxjs/operators";
import { HttpClient } from "@angular/common/http";

import { ResponseHttp } from "../models/response-http";
import { environment } from "../../environments/environment";
import { Lead } from "../models/lead";

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

  public checkLead(lead: Lead): Observable<{ exist: boolean, item: Lead }> {
    return this.http.post<ResponseHttp>(`${this.apiUrl}/api/admin/leads/create/check`, lead)
      .pipe(
        map((data: ResponseHttp) => ({ exist: data.data.exist, item: data.data.item })),
        catchError((error) => throwError(error))
      );
  }

  public updateLead(lead: Lead): Observable<Lead> {
    return this.http.put<ResponseHttp>(`${this.apiUrl}/api/admin/leads/${lead.id}`, lead)
      .pipe(
        map((data: ResponseHttp) => data.data.item),
        catchError((error) => throwError(error))
      );
  }

  public storeLead(lead: Lead): Observable<Lead> {
    return this.http.post<ResponseHttp>(`${this.apiUrl}/api/admin/leads`, lead)
      .pipe(
        map((data: ResponseHttp) => data.data.item),
        catchError((error) => throwError(error))
      );
  }
}
