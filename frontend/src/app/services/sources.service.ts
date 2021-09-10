import { Injectable } from '@angular/core';
import { Observable, throwError } from "rxjs";
import { HttpClient } from "@angular/common/http";
import { catchError, map } from "rxjs/operators";

import { Source } from "../models/source";
import { ResponseHttp } from "../models/response-http";
import { environment } from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class SourcesService {
  private apiUrl = environment.apiUrl;

  constructor(
    private http: HttpClient,
  ) { }

  public getSources(): Observable<Source[]> {
    return this.http.get<ResponseHttp>(`${this.apiUrl}/api/admin/sources`)
      .pipe(
        map((data) => data.data.items),
        catchError((error) => throwError(error))
      );
  }

  public deleteSource(source: Source): Observable<Source> {
    return this.http.delete<ResponseHttp>(`${this.apiUrl}/api/admin/sources/${source.id}`)
      .pipe(
        map((data) => data.data.item),
        catchError((error) => throwError(error))
      );
  }
}
