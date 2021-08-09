import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class PreloaderService {
  private static fullLoadingCount: number = 0;

  constructor() { }

  public getPreloaderCount(): number {
    return PreloaderService.fullLoadingCount;
  }

  public showPreloader(): void {
    PreloaderService.fullLoadingCount++;
  }

  public hidePreloader(): void {
    setTimeout(() => {
      PreloaderService.fullLoadingCount--;
    }, 1500);
  }
}
