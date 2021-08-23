import { Injectable } from '@angular/core';
import { Observable, throwError } from "rxjs";
import { HttpClient } from "@angular/common/http";
import { catchError, map } from "rxjs/operators";

import { Unit } from "../models/unit";
import { environment } from "../../environments/environment";
import { ResponseHttp } from "../models/response-http";

@Injectable({
  providedIn: 'root'
})
export class UnitsService {
  private apiUrl = environment.apiUrl;

  constructor(
    private http: HttpClient,
  ) { }

  public getUnits(): Observable<Unit[]> {
    return this.http.get<ResponseHttp>(`${this.apiUrl}/api/admin/units`)
      .pipe(
        map((data) => data.data.items),
        catchError((error) => throwError(error))
      );
  }
}
