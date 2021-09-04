import { Injectable } from '@angular/core';
import { Observable, throwError } from "rxjs";
import { ResponseHttp } from "../models/response-http";
import { catchError, map } from "rxjs/operators";
import { environment } from "../../environments/environment";
import { HttpClient } from "@angular/common/http";
import { LeadComment } from "../models/lead-comment";
import { Lead } from "../models/lead";

@Injectable({
  providedIn: 'root'
})
export class LeadCommentService {
  private apiUrl = environment.apiUrl;

  constructor(
    private http: HttpClient,
  ) { }

  getComments(id: number): Observable<LeadComment[]> {
    return this.http.get<ResponseHttp>(`${this.apiUrl}/api/admin/leads/history/${id}`)
      .pipe(
        map((data) => data.data.items),
        catchError((error) => throwError(error))
      );
  }

  storeLeadComment(leadComment: LeadComment): Observable<Lead> {
    return this.http.post<ResponseHttp>(`${this.apiUrl}/api/admin/lead-comments`, leadComment)
      .pipe(
        map((data) => data.data.item),
        catchError((error) => throwError(error))
      );
  }
}
