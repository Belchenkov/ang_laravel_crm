import { Injectable } from '@angular/core';
import { catchError, map } from "rxjs/operators";
import { Observable, throwError } from "rxjs";
import { HttpClient } from "@angular/common/http";

import { Task } from "../models/task";
import { ResponseHttp } from "../models/response-http";
import { environment } from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class TasksService {
  private apiUrl = environment.apiUrl;

  constructor(
    private http: HttpClient,
  ) { }

  storeTask(task: Task): Observable<Task> {
    return this.http.post<ResponseHttp>(`${this.apiUrl}/api/admin/tasks`, task)
      .pipe(
        map((data: ResponseHttp) => data.data.item),
        catchError((error) => throwError(error))
      );
  }
}
