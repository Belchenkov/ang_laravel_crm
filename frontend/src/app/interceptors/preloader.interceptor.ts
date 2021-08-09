import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor, HttpResponse
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { tap } from "rxjs/operators";

import { PreloaderService } from "../services/preloader/preloader.service";

@Injectable()
export class PreloaderInterceptor implements HttpInterceptor {

  constructor(
    private preloaderService: PreloaderService
  ) { }

  intercept(request: HttpRequest<unknown>, next: HttpHandler): Observable<HttpEvent<unknown>> {
    this.startRequest();
    return next.handle(request)
      .pipe(
        tap((event: HttpEvent<any>) => {
          if (event instanceof HttpResponse) {
            this.endRequest();
          }
        },
  (err: any) => {
            console.error('Intercept error: ', err);
            this.endRequest();
        })
      );
  }

  private startRequest(): void {
    this.preloaderService.showPreloader();
  }

  private endRequest(): void {
    this.preloaderService.hidePreloader();
  }
}
