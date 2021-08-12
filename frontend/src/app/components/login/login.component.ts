import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { ActivatedRoute, Router } from "@angular/router";

import { AuthService } from "../../services/auth/auth.service";
import { User } from "../../models/user";
import { catchError } from "rxjs/operators";
import { throwError } from "rxjs";
import { ResponseHttp } from "../../models/response-http";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  public loginForm: FormGroup;
  public submitted: boolean = false;
  public returnUrl: string = "form";
  public loading: boolean = false;
  public error: string = "";

  constructor(
    private formBuilder: FormBuilder,
    private authService: AuthService,
    private router: Router,
    private route: ActivatedRoute,
  ) { }

  ngOnInit(): void {
    this.userLogout();
    this.setLoginForm();
  }

  get f() {
    return this.loginForm.controls;
  }

  private setLoginForm(): void {
    this.loginForm = this.formBuilder.group({
      email: ['', Validators.required],
      password: ['', Validators.required],
    });
  }

  private userLogout(): void {
    this.authService.logout();
  }

  public onSubmit(): void | boolean {
    this.submitted = true;

    if (this.loginForm.invalid) {
      return false;
    }

    this.authService.login(this.f.email.value, this.f.password.value)
      .pipe(
        catchError((err: any) => {
          this.error = (err.error as ResponseHttp).errors.message;
          return throwError(err);
        })
      )
      .subscribe((user: User) => {
        if (user) {
          this.router.navigate([this.redirectTo()]);
        }
      });
  }

  private redirectTo(): string {
      return this.route.snapshot.paramMap.get('returnUrl') || this.returnUrl;
  }
}
