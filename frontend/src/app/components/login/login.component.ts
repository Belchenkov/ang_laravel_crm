import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from "@angular/forms";

import { AuthService } from "../../services/auth/auth.service";

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
    private authService: AuthService
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

    this.authService.login();
  }

}
