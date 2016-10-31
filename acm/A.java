// UBC+

import java.util.*;

public class A{
	public static int length(long i) {
		int len = 1;
		long k = Math.abs(i);
		while (k >= 10L) {
			k /= 10L;
			len++;
		}
		if (i < 0) len++;
		return len;
	}
	public static void main(String[] args) {
		Scanner sc = new Scanner(System.in);
		int n = sc.nextInt();
		/*for (int i = -20; i < 21; ++i) {
			System.out.printf("%d %d\n", i, length(i));
		}*/
		while (n-- != 0) {
			String s = sc.next();
			long a = 0, b = 0, c = 0;
			long qa = 0, qb = 0, qc = 0;
			int j = 0, i = 0;
			int la, lb, lc;
			boolean neg = false;
			boolean[] seen = {false, false, false, false, false, false, false, false, false, false};
			for (i = j;; ++i) {
				if (i != j && ((s.charAt(i) == '+') || (s.charAt(i) == '-') || (s.charAt(i) == '*'))) break;
				if (s.charAt(i) == '-') { neg = true; continue; }
				a *= 10; qa *= 10;
				if (s.charAt(i) == '?') {
					qa += 1;
				} else {
					long asdf = Long.parseLong(s.substring(i, i+1));
					a += asdf;
					seen[(int)asdf] = true;
				}
			}
			if (neg) { a *= -1; qa*=-1;}
			la = i - j;
			j = ++i;
			neg = false;
			for (;; ++i) {
				if (s.charAt(i) == '=') break;
				if (s.charAt(i) == '-') { neg = true; continue; }
				b *= 10; qb *= 10;
				if (s.charAt(i) == '?') {
					qb += 1;
				} else {
					long asdf = Long.parseLong(s.substring(i, i+1));
					b += asdf;
					seen[(int)asdf] = true;
				}
			}
			if (neg) { b *= -1; qb*=-1;}
			lb = i - j;
			j = ++i;
			neg = false;
			for (; i < s.length(); ++i) {
				if (s.charAt(i) == '-') { neg = true; continue; }
				c *= 10; qc *= 10;
				if (s.charAt(i) == '?') {
					qc += 1;
				} else {
					long asdf = Long.parseLong(s.substring(i, i+1));
					c += asdf;
					seen[(int)asdf] = true;
				}
			}
			if (neg) {c *= -1; qc*=-1;}
			lc = i - j;
			//System.out.println(" -- " + a + " " + b + " " + c);
			//System.out.println(" -- " + qa + " " + qb + " " + qc);
			//System.out.println(" -- " + la + " " + lb + " " + lc);
			boolean found = false;
			if (s.contains("+")) {
				for (i = 0; i < 10; ++i) {
					if (seen[i]) continue;
					if ((a + qa * i) + (b + qb * i) == (c + qc * i)) {
						if (la != length(a + qa * i)) continue;
						if (lb != length(b + qb * i)) continue;
						if (lc != length(c + qc * i)) continue;
						System.out.println(i);
						found = true;
						break;
					}
				}
			} else if (s.contains("*")) {
				for (i = 0; i < 10; ++i) {
					if (seen[i]) continue;
					if ((a + qa * i) * (b + qb * i) == (c + qc * i)) {
						if (la != length(a + qa * i)) continue;
						if (lb != length(b + qb * i)) continue;
						if (lc != length(c + qc * i)) continue;
						System.out.println(i);
						found = true;
						break;
					}
				}
			} else {
				for (i = 0; i < 10; ++i) {
					if (seen[i]) continue;
					if ((a + qa * i) - (b + qb * i) == (c + qc * i)) {
						if (la != length(a + qa * i)) continue;
						if (lb != length(b + qb * i)) continue;
						if (lc != length(c + qc * i)) continue;
						System.out.println(i);
						found = true;
						break;
					}
				}
			}
			if (!found) System.out.println(-1);
		}
	}
}
