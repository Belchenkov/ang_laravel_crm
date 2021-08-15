import { Injectable } from '@angular/core';
import { HttpEvent, HttpHandler, HttpInterceptor, HttpRequest } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Router } from "@angular/router";

import { AuthService } from "../services/auth/auth.service";

@Injectable()
export class LogoutInterceptor implements HttpInterceptor {
  private redirectUrl: string = '/login';

  constructor(
    private authService: AuthService,
    private router: Router
  ) {}

  intercept(request: HttpRequest<unknown>, next: HttpHandler): Observable<HttpEvent<unknown>> {
    return new Observable<HttpEvent<any>>((subscriber) => {
      const originalRequestSubscription = next.handle(request)
        .subscribe((response) => {
            subscriber.next(response);
          },
          (err) => {
            if (err.status === 401) {
              this.authService.logout();
              this.router.navigate(this.redirectTo());
              subscriber.error("Not Authorized");
            } else {
              subscriber.error(err);
            }
          },
          () => {
            subscriber.complete();
          });

      return () => {
        originalRequestSubscription.unsubscribe();
      };
    });
  }

  private redirectTo(): string[] {
    return [this.redirectUrl];
  }
}
