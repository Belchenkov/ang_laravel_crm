import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor() { }

  public checkUser(): boolean {
    return true;
  }

  public logout(): void {

  }

  public login() {

  }
}
